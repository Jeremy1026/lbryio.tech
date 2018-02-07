$(document).ready(function() {

  var allMethods = ["blob_announce","blob_delete","blob_get","blob_list","blob_reflect_all","block_show","channel_list_mine","channel_new","claim_abandon","claim_list","claim_list_by_channel","claim_list_mine","claim_new_support","claim_send_to_address","claim_show","cli_test_command","commands","daemon_stop","file_delete","file_list","file_reflect","file_set_status","get","get_availability","help","peer_list","publish","report_bug","resolve","resolve_name","routing_table_get","settings_get","settings_set","status","stream_cost_estimate","transaction_list","transaction_show","utxo_list","version","wallet_balance","wallet_is_address_mine","wallet_list","wallet_new_address","wallet_prefill_addresses","wallet_public_key","wallet_send","wallet_unused_address"];

  var methodParams = { "help": "command" };

  var basePrompt = "lbry-daemon$ ";

  function parseInput(editor) {
    var input = editor.getRange({line: editor.getCursor().line,ch: 0}, {line: editor.getCursor().line});
    if (input.indexOf('./lbrynet-cli') === -1) {
      return {"isValidMethod": false, "method": method, "response": "You need to enter ./lbrynet-cli to use the API."};
    }

    input = editor.getRange({line: editor.getCursor().line,ch: basePrompt.length + 14}, {line: editor.getCursor().line,ch: editor.getCursor().ch});
    if (input.indexOf(' ') !== -1) {
      var method = input.substr(0,input.indexOf(' '));
    }
    else {
      var method = input;
    }
    var params = ltrim(input.substr(input.indexOf(method) + method.length));
    var paramsArray
    if (params.length > 0) {
      paramsArray = params.split(" ");
    }
    else {
      paramsArray = null;
    }
    if (checkValidMethod(method) !== -1) {
      return {"isValidMethod": true, "method": method, "params": paramsArray};
    }
    return {"isValidMethod": false, "method": method, "response": getFailedResponse()};
  }

  function ltrim(str) {
    if(str == null) return str;
    return str.replace(/^\s+/g, '');
  }

  function checkValidMethod(method) {
    return validMethods.indexOf(method);
  }

  function runMethod(cm, method, params) {
    var baseURL = 'http://daemon.lbry.tech/?method=';
    var url = '';
    // @todo support unnamed params
    if (params) {
      var paramString = generateParamString(params);
      url = baseURL + method + "&" + paramString;
    }
    else {
      url = baseURL + method;
    }
    var jqxhr = $.ajax( url )
      .done(function(result) {
        cm.replaceSelection('\n'+JSON.stringify(result["result"], null, 4 )+'\n'+basePrompt);
      })
      .fail(function() {
        cm.replaceSelection('\nThere was an error processing your input.\n'+basePrompt);
      })
  }

  function generateParamString(params) {
    paramsDict = [];
    params.forEach(function(param, index) {
      if (param.indexOf('--') !== -1) {
        param = param.replace('--','');
        paramsDict.push(param+"="+params[index+1]);
        params.splice(index+1,1);
      }
    });
    return paramsDict;  
  }

  function insertHistory(cm, editor, historyLevel) {
    if (previousInputs[historyLevel]) {
      var from = {line: editor.getCursor().line, ch: 0};
      var to = {line: editor.getCursor().line};
      cm.replaceRange(basePrompt + previousInputs[historyLevel], from, to);
      return true;
    }
    return false;
  }

  var previousInputs = [];
  var lastLine = -1;
  var historyLevel = 0;
  var editor = CodeMirror.fromTextArea(document.getElementById("editor"), {
    lineNumbers: false,
    mode: "shell",
    matchBrackets: true
  });

  editor.setOption("theme", "lesser-dark");

  editor.setOption("extraKeys", {
    Enter: function(cm) {
      previousInputs.push(editor.getRange({line: editor.getCursor().line,ch: basePrompt.length}, {line: editor.getCursor().line,ch: editor.getCursor().ch}));
      inputResults = parseInput(editor);
      if (inputResults["isValidMethod"]) {
        runMethod(cm, inputResults["method"], inputResults["params"]);
        if (inputResults["method"] === lessonGoal) {
          $('#nextButton').removeAttr('disabled');
          $('#successMessage').show();
        }
      }
      else {
        var addPrompt = "\n"+inputResults['response']+'\n'+basePrompt;
        cm.replaceSelection(addPrompt);
      }
      historyLevel = 0;
      lastLine = editor.getCursor().line;
    },
    Up: function(cm) {
      if (historyLevel < previousInputs.length) {
        if (insertHistory(cm, editor, historyLevel)) {
          historyLevel++;
        }
      }
    },
    Down: function(cm) {
      if (historyLevel > 0) {
        historyLevel--;
        insertHistory(cm, editor, historyLevel)
      }        
    }
  });

  editor.on('beforeChange',function(cm,change) {
    // if (( change.from.line < lastLine) || ( change.from.ch < basePrompt.length)) {
    //   change.cancel();
    // }
  });
});