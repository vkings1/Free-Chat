<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta name="description" content="Simplest possible examples of HTML, CSS and JavaScript.">
<meta name="author" content="//samdutton.com">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta itemprop="name" content="simpl.info: simplest possible examples of HTML, CSS and JavaScript">
<meta itemprop="image" content="/images/icons/icon192.png">
<meta id="theme-color" name="theme-color" content="#fff">



<base target="_blank">


<title>RTCPeerConnection</title>

<link rel="stylesheet" href="../css/main.css">

<style>
  button {
    margin: 0 20px 0 0;
    width: 85.9px;
  }

  button#hangupButton {
    margin: 0;
  }

  p.borderBelow {
    margin: 0 0 1.5em 0;
    padding: 0 0 1.5em 0;
  }

  video {
    height: 225px;
    margin: 0 0 20px 0;
    vertical-align: top;
    width: calc(50% - 13px);
  }

  video#localVideo {
    margin: 0 20px 20px 0;
  }

  @media (max-width: 400px) {

    button {
      width: 83px;
    }

    button {
      margin: 0 11px 10px 0;
    }

    video {
      height: 90px;
      margin: 0 0 10px 0;
      width: calc(50% - 7px);
    }

    video#localVideo {
      margin: 0 10px 20px 0;
    }

  }
</style>

</head>

<body>

  <div id="container">

    <div id="highlight">
			<p>HTML, CSS and JavaScript feature support across top browsers:
			  <br><br>
			</p>
		</div>

    <video id="localVideo" autoplay muted playsinline></video>
    <video id="remoteVideo" autoplay playsinline></video>

    <div>
      <button id="startButton">Start</button>
      <button id="callButton">Call</button>
      <button id="hangupButton">Hang Up</button>
    </div>

    <p>View the console to see logging. The <code>MediaStream</code> object <code>localStream</code>, and the <code>RTCPeerConnection</code> objects <code>localPeerConnection</code> and <code>remotePeerConnection</code> are in global scope, so you can inspect them in the console as well.</p>

    <script src="main.js"></script>



  </div>

</body>

</html>
