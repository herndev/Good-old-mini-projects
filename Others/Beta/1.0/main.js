// Beta 1.0 js


// Declaration and initialization
const video = document.getElementById("video");
const capture = document.getElementById( "capture" );
const snapshot = document.getElementById( "snapshot" );
const model_url = '/test/models';
var cameraStream = null;
var image = null;
var displaySize = null;



//DETECTOR--------------------------------------------------
// Promises
Promise.all([
	faceapi.nets.faceLandmark68Net.loadFromUri(model_url),
	faceapi.nets.faceRecognitionNet.loadFromUri(model_url),
	faceapi.nets.ssdMobilenetv1.loadFromUri(model_url),
]).then(startVid());

function startVid() {
    var mediaSupport = 'mediaDevices' in navigator;
    if( mediaSupport && null == cameraStream ) {
        navigator.mediaDevices.getUserMedia( { video: true } )
        .then( function( mediaStream ) {
            cameraStream = mediaStream;
            video.srcObject = mediaStream;
            video.play();
        })
        .catch( function( err ) {
            console.log( "Unable to access camera: " + err );
        });
    }
    else {
        alert( 'Your browser does not support media devices.' );
        return;
    }
}


// Action while playing video
video.addEventListener('playing', function(){
  const canvas = faceapi.createCanvasFromMedia(video)
  //document.body.append(canvas)
  displaySize = { width: video.width, height: video.height }
  
  faceapi.matchDimensions(canvas, displaySize)

  setInterval(async function(){
    const detections = await faceapi.detectAllFaces(video).withFaceLandmarks().withFaceDescriptors()
    const resizedDetections = faceapi.resizeResults(detections, displaySize)
    //canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height)
    if (detections['length'] > 0) {
    	captureSnapshot();
    	stopVid();
    	startIdentify();
      //startVid();
    }
  }, 100);
});



// Stop Streaming
function stopVid() {
    if( null != cameraStream ) {
        var track = cameraStream.getTracks()[ 0 ];
        track.stop();
        video.load();
        cameraStream = null;
    }
}
//END DETECTOR--------------------------------------------



//CAPTURE-------------------------------------------------
function captureSnapshot() {
    if( null != cameraStream ) {
        var ctx = capture.getContext( '2d' );
        var img = new Image();
        ctx.drawImage( video, 0, 0, capture.width, capture.height );
   
        img.src     = capture.toDataURL( "image/png" );
        img.width   = 240;
        //console.log(img)
        //snapshot.innerHTML = '';
        //snapshot.appendChild( img );
        image = img;
    }
}
//END CAPTURE---------------------------------------------



//Identify Person----------------------------------------
async function startIdentify() {
 	const container = document.createElement('div')
 	container.style.position = 'relative'
 	document.body.append(container)
 	const labeledFaceDescriptors = await loadLabeledImages()
 	const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.6)
 	let canvas
 	//document.body.append('Loaded')

	if (image) image.remove()
	if (canvas) canvas.remove()
	//image = await faceapi.bufferToImage(imageUpload.files[0])
	
  container.append(image)
	canvas = faceapi.createCanvasFromMedia(image)
	container.append(canvas)
	
	//faceapi.matchDimensions(canvas, displaySize)
	const detections = await faceapi.detectAllFaces(image).withFaceLandmarks().withFaceDescriptors()
	const resizedDetections = faceapi.resizeResults(detections, displaySize)
	const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor))
	results.forEach((result, i) => {
	  const box = resizedDetections[i].detection.box
	  const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() })
	  drawBox.draw(canvas)

    console.log(result.toString());
    var name = result.toString();
    window.open('sample.php?name=' + "'" + name.split("(")[0].substring(0,name.length-1) + "'", '_blank');
    location.reload();
	})
  console.log("END OF PROGRAM");
}


function loadLabeledImages() {
  const labels = ['Black Widow', 'Captain America', 'Captain Marvel', 'Hawkeye', 'Jim Rhodes', 'Thor', 'Tony Stark', 'Hernie Jabien']
  return Promise.all(
    labels.map(async label => {
      const descriptions = []
      for (let i = 1; i <= 2; i++) {
        const img = await faceapi.fetchImage(`/FaceRec3/labeled_images/${label}/${i}.jpg`)
        const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
        descriptions.push(detections.descriptor)
      }

      return new faceapi.LabeledFaceDescriptors(label, descriptions)
    })
  )
}