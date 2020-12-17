/*(function() {

	navigator.getMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia);// body...
	navigator.getMedia(

		{video:true,audio:false},

		function(stream){
			var video = document.getElementById("video");
			video.src = window.URL.createObjectURL(stream);
			video.play();
		},

		function(error){
			console.log(error);
		}
	)
})();
*/
var video = document.getElementById("video");


Promise.all([
	faceapi.nets.tinyFaceDetector.loadFromUri('./models'),
	faceapi.nets.faceLandmark68Net.loadFromUri('./models'),
	faceapi.nets.faceRecognitionNet.loadFromUri('./models'),
	faceapi.nets.faceExpressionNet.loadFromUri('./models'),
]).then(startVid());

/*(function() {
	var video = document.getElementById("video");
	navigator.getMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia);// body...
	navigator.getMedia(

		{video:true,audio:false},

		stream => video.srcObject = stream
		,

		function(error){
			console.log(error);
		}
	)
})();
*/

function startVid() {
	navigator.getMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia);// body...
	navigator.getMedia(

		{video:true,audio:false},

		stream => video.srcObject = stream
		,

		function(error){
			console.log(error);
		}
	)
}


