<?php if($method=="videoCall"){?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Google Meet Style Agora Call</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { margin: 0; background-color: #202124; color: white; font-family: 'Roboto', sans-serif; }
        
        /* Video Grid Layout */
        #video-container { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); 
            gap: 15px; 
            padding: 20px; 
            height: calc(100vh - 100px);
            align-content: center;
        }

        .video-player { 
            width: 100%; 
            height: 100%; 
            min-height: 240px;
            background-color: #3c4043; 
            border-radius: 8px; 
            overflow: hidden; 
            position: relative;
        }

        /* Bottom Control Bar */
        .controls-bar {
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 80px;
            background-color: #202124;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        .btn-control {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: none;
            background-color: #3c4043;
            color: white;
            cursor: pointer;
            font-size: 20px;
            transition: 0.3s;
        }

        .btn-control:hover { background-color: #4a4d51; }
        .btn-control.off { background-color: #ea4335; }
        .btn-leave { background-color: #ea4335; width: 80px; border-radius: 25px; }
        .btn-leave:hover { background-color: #d93025; }

        #join-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
    </style>
</head>
<body>

    <div id="join-container">
        <h2>Join Meeting</h2>
        <input type="text" id="channel-name" value="<?php echo $channel_name; ?>" style="padding: 10px; border-radius: 5px;">
        <button id="join-btn" class="btn-control" style="width: auto; padding: 0 20px; border-radius: 5px;">Join</button>
    </div>

    <div id="video-container" style="display: none;">
        <div id="local-player" class="video-player"></div>
    </div>

    <div class="controls-bar" id="controls" style="display: none;">
        <button id="mic-btn" class="btn-control"><i class="fas fa-microphone"></i></button>
        <button id="video-btn" class="btn-control"><i class="fas fa-video"></i></button>
        <button id="share-btn" class="btn-control"><i class="fas fa-desktop"></i></button>
        <button id="leave-btn" class="btn-control btn-leave"><i class="fas fa-phone-slash"></i></button>
    </div>

    <script src="https://download.agora.io/sdk/release/AgoraRTC_N-4.20.0.js"></script>
    <script>
        const APP_ID = "<?php echo $app_id; ?>";
        const TOKEN = "<?php echo $temp_token; ?>";
        let CHANNEL = "<?php echo $channel_name; ?>";

        let client = AgoraRTC.createClient({ mode: "rtc", codec: "vp8" });
        let localTracks = { videoTrack: null, audioTrack: null, screenTrack: null };
        let isMicOn = true;
        let isVideoOn = true;
        let isScreenSharing = false;

        const joinBtn = document.getElementById('join-btn');
        const leaveBtn = document.getElementById('leave-btn');
        const micBtn = document.getElementById('mic-btn');
        const videoBtn = document.getElementById('video-btn');
        const shareBtn = document.getElementById('share-btn');

        joinBtn.onclick = async function() {
            try {
                CHANNEL = document.getElementById('channel-name').value;
                await client.join(APP_ID, CHANNEL, TOKEN, null);
                
                localTracks.audioTrack = await AgoraRTC.createMicrophoneAudioTrack();
                localTracks.videoTrack = await AgoraRTC.createCameraVideoTrack();
                
                document.getElementById('video-container').style.display = 'grid';
                document.getElementById('controls').style.display = 'flex';
                document.getElementById('join-container').style.display = 'none';

                localTracks.videoTrack.play("local-player");
                await client.publish([localTracks.audioTrack, localTracks.videoTrack]);
            } catch (error) {
                console.error(error);
            }
        };

        // 1. Mute/Unmute Feature (Google Meet Style)
        micBtn.onclick = async function() {
            if (isMicOn) {
                await localTracks.audioTrack.setEnabled(false);
                micBtn.classList.add('off');
                micBtn.innerHTML = '<i class="fas fa-microphone-slash"></i>';
                isMicOn = false;
            } else {
                await localTracks.audioTrack.setEnabled(true);
                micBtn.classList.remove('off');
                micBtn.innerHTML = '<i class="fas fa-microphone"></i>';
                isMicOn = true;
            }
        };

        // 2. Camera On/Off Feature
        videoBtn.onclick = async function() {
            if (isVideoOn) {
                await localTracks.videoTrack.setEnabled(false);
                videoBtn.classList.add('off');
                videoBtn.innerHTML = '<i class="fas fa-video-slash"></i>';
                isVideoOn = false;
            } else {
                await localTracks.videoTrack.setEnabled(true);
                videoBtn.classList.remove('off');
                videoBtn.innerHTML = '<i class="fas fa-video"></i>';
                isVideoOn = true;
            }
        };

        // 3. Screen Sharing Feature
        shareBtn.onclick = async function() {
            if (!isScreenSharing) {
                localTracks.screenTrack = await AgoraRTC.createScreenVideoTrack();
                await client.unpublish(localTracks.videoTrack);
                await client.publish(localTracks.screenTrack);
                localTracks.screenTrack.play("local-player");
                shareBtn.classList.add('off');
                isScreenSharing = true;

                // Handle if user stops sharing via browser UI
                localTracks.screenTrack.on("track-ended", () => stopScreenShare());
            } else {
                stopScreenShare();
            }
        };

        async function stopScreenShare() {
            await client.unpublish(localTracks.screenTrack);
            localTracks.screenTrack.close();
            await client.publish(localTracks.videoTrack);
            localTracks.videoTrack.play("local-player");
            shareBtn.classList.remove('off');
            isScreenSharing = false;
        }

        // Handle Remote Users
        client.on("user-published", async (user, mediaType) => {
            await client.subscribe(user, mediaType);
            if (mediaType === "video") {
                const remotePlayer = document.createElement("div");
                remotePlayer.id = `user-${user.uid}`;
                remotePlayer.className = "video-player";
                document.getElementById("video-container").appendChild(remotePlayer);
                user.videoTrack.play(remotePlayer.id);
            }
            if (mediaType === "audio") {
                user.audioTrack.play();
            }
        });

        client.on("user-unpublished", (user) => {
            const remotePlayer = document.getElementById(`user-${user.uid}`);
            if (remotePlayer) remotePlayer.remove();
        });

        leaveBtn.onclick = async function() {
            for (let trackName in localTracks) {
                if (localTracks[trackName]) {
                    localTracks[trackName].stop();
                    localTracks[trackName].close();
                }
            }
            await client.leave();
            location.reload(); // Refresh to join screen
        };
    </script>
</body>
</html>
<?php
} else {
    ?>
<h1>U not a valid User
<?php
}?>