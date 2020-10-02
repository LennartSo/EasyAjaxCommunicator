/*
 * EasyAjaxCommunicator
 *
 * @author Lennart Sommerfeld
 * @copyright (c) Lennart Sommerfeld
 * @link http://lennart-sommerfeld.de
 * @version 1.0
 */
/* best way to communicate with database*/

XMLHttpRequest.prototype.targetFunction = '';
XMLHttpRequest.prototype.targetFunctionPara = '';

XMLHttpRequest.prototype.compileData = function () {

    var functionObject = {};
    functionObject[this.targetFunction] = [];

    var functionParameter = this.targetFunctionPara;

    for (var i = 0; i < functionParameter.length; i++) {
        functionObject[this.targetFunction][i] = functionParameter[i];
    }

    return encodeURIComponent(JSON.stringify(functionObject));

};

XMLHttpRequest.prototype.sendData = function(target){
    this.open("POST",target);
    this.setRequestHeader("Content-type","application/x-www-form-urlencoded; charset=utf-8");

    var senDataString = "EasyAjaxJSONString="+this.compileData();

    this.send(senDataString);
};
