$(document).ready(function() {

  var allMethods = ["blob_announce","blob_delete","blob_get","blob_list","blob_reflect_all","block_show","channel_list_mine","channel_new","claim_abandon","claim_list","claim_list_by_channel","claim_list_mine","claim_new_support","claim_send_to_address","claim_show","cli_test_command","commands","daemon_stop","file_delete","file_list","file_reflect","file_set_status","get","get_availability","help","peer_list","publish","report_bug","resolve","resolve_name","routing_table_get","settings_get","settings_set","status","stream_cost_estimate","transaction_list","transaction_show","utxo_list","version","wallet_balance","wallet_is_address_mine","wallet_list","wallet_new_address","wallet_prefill_addresses","wallet_public_key","wallet_send","wallet_unused_address"];

  var basePrompt = "lbry-daemon$ ./lbrynet-cli ";

  function parseInput(editor) {
    var input = editor.getRange({line: editor.getCursor().line,ch: basePrompt.length}, {line: editor.getCursor().line,ch: editor.getCursor().ch});
    if (input.indexOf(' ') !== -1) {
      var method = input.substr(0,input.indexOf(' '));
    }
    else {
      var method = input;
    }
    var params = input.substr(input.indexOf(method) + method.length);
    if (checkValidMethod(method) !== -1) {
      return {"isValidMethod": true, "method": method, "params":params};
    }
    return {"isValidMethod": false, "method": method};
  }

  function checkValidMethod(method) {
    return validMethods.indexOf(method);
  }

  function runMethod(method, cm) {
    var baseURL = 'http://daemon.lbry.tech/?method=';
    var jqxhr = $.ajax( baseURL + method )
      .done(function(result) {
        // console.log( JSON.stringify(result["result"] ));
        cm.replaceSelection('\n'+JSON.stringify(result["result"], null, 4 )+'\n'+basePrompt);
      })
      .fail(function() {
        // alert( "error" );
      })
      .always(function() {
      });
  }

  var lastLine = -1;
  var editor = CodeMirror.fromTextArea(document.getElementById("editor"), {
    lineNumbers: false,
    mode: "text/javascript",
    matchBrackets: true,
  });

  editor.setOption("theme", "lesser-dark");

  editor.setOption("extraKeys", {
    Enter: function(cm) {
      inputResults = parseInput(editor);
      if (inputResults["isValidMethod"]) {
        console.log( runMethod(inputResults["method"], cm) );
      }
      else {
        var addPrompt = '\nERROR: "'+inputResults["method"]+'" is not a valid command.\n'+basePrompt;
        cm.replaceSelection(addPrompt);
      }
      lastLine = editor.getCursor().line;
    }
  });

  editor.on('beforeChange',function(cm,change) {
    if (( change.from.line < lastLine) || ( change.from.ch < basePrompt.length)) {
      change.cancel();
    }
  });
});