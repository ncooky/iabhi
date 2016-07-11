var dialogWin = new Object();

function showDialog(dialogInfo, dialogName, pageUrl, dialogWidth, dialogHeight, returnFunc, parentWindow) {
  if (!dialogWin.win || (dialogWin.win && dialogWin.win.closed)) {
    dialogWin.returnFunc = returnFunc;
    dialogWin.returnedValue = "";
    dialogWin.url = pageUrl;
    dialogWin.width = dialogWidth;
    dialogWin.height = dialogHeight;
    dialogWin.name = (new Date()).getSeconds().toString();

    if (!parentWindow)
      parentWindow = window;

    if (window.showModalDialog) {
      dialogWin.returnedValue = parentWindow.showModalDialog(pageUrl, dialogInfo, "dialogWidth:" + dialogWidth + "px;dialogHeight:" + dialogHeight + "px;help:no;scroll:no;status:no");
  
      if (dialogWin.returnedValue) dialogWin.returnFunc(dialogWin.returnedValue);
    } else {
      var iTop = (screen.height - dialogHeight)/2;
      var iLeft = (screen.width  - dialogWidth)/2;

      var sOption  = "location=no,menubar=no,toolbar=no,dependent=yes,dialog=yes,minimizable=no,modal=yes,alwaysRaised=yes" +
        ",resizable=no" +
        ",width=" + dialogWidth +
        ",height=" + dialogHeight +
        ",top=" + iTop +
        ",left=" + iLeft;

      dialogWin.win = parentWindow.open('', dialogName, sOption, true);
    
      if (!dialogWin.win) {
        dialogWin.win = null;
      } else {
        dialogWin.win.moveTo(iLeft, iTop);
        dialogWin.win.resizeTo(dialogWidth, dialogHeight);
        dialogWin.win.focus();
        dialogWin.win.location.href = pageUrl;
	  }
    }
  } else {
    dialogWin.win.focus()
  }
}