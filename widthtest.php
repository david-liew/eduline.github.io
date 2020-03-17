<!DOCTYPE html>
<html>
<head>
<style type="text/css">
body{margin:;padding:}
div{background:blue;width:100%;height:auto;margin:0 auto}
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
<body>
<div>hi</div>

<p>Click the button to display this frame's height and width.</p>

<button onclick="myFunction()">Try it</button>

<p><strong>Note:</strong> The innerWidth and innerHeight properties are not supported in IE8 and earlier.</p>

<p id="demo"></p>

<script>
function myFunction() {
  var w = window.innerWidth;
  var h = window.innerHeight;
  document.getElementById("demo").innerHTML = "Width: " + w + "<br>Height: " + h;
}
</script>
</body>
</html>
