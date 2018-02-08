$(document).ready(function() {

  function insertHistory(cm, editor, historyLevel) {
    if (inputHistory[historyLevel]) {
      var from = {line: editor.getCursor().line, ch: 0};
      var to = {line: editor.getCursor().line};
      cm.replaceRange(basePrompt + inputHistory[historyLevel], from, to, "@ignore");
      return true;
    }
    return false;
  }

  function saveCurrentInputToHistory() {
    inputHistory.push(getLastInput());
  }

  function getLastInput() {
    var from = {line: editor.getCursor().line,ch: basePrompt.length};
    var to = {line: editor.getCursor().line,ch: editor.getCursor().ch};
    return editor.getRange(from, to);
  }

  var inputHistory = [];
  var lastLine = -1;
  var historyLevel = 0;
  var editor = CodeMirror.fromTextArea(document.getElementById("editor"), {
    lineNumbers: false,
    mode: "shell",
    matchBrackets: true,
    autofocus: true
  });

  editor.setCursor({line:0});

  editor.setOption("theme", "lesser-dark");

  editor.setOption("extraKeys", {
    Enter: function(cm) {
      saveCurrentInputToHistory();
      inputResults = parseInput(editor);
      if (inputResults["isValidMethod"]) {
        updateLessonStatus(inputResults["method"], inputResults["params"]);
        runMethod(cm, inputResults["method"], inputResults["params"]);
        if (isLessonComplete()) {
          $('#successMessage').show("blind", null, 500);
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
      if (historyLevel < inputHistory.length) {
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
    if (change.origin === "@ignore") return;
    if (( change.from.line < lastLine) || ( change.from.ch < basePrompt.length)) {
      change.cancel();
    }
  });
});