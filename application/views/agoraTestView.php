<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Call - <?php echo $channel_name; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-dark: #202124;
            --bg-surface: #3c4043;
            --text-primary: #ffffff;
            --danger: #ea4335;
            --primary-blue: #8ab4f8;
            --border-color: #5f6368;
            --placeholder-bg: #00695c;
            --avatar-bg: #00acc1;
        }

        body {
            margin: 0; padding: 0;
            font-family: 'Google Sans', Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-primary);
            height: 100vh; display: flex; flex-direction: column; overflow: hidden;
        }

        /* --- LOBBY LAYOUT --- */
        #lobby-container {
            display: flex; flex: 1; align-items: center; justify-content: center;
            padding: 20px; gap: 80px;
        }

        .lobby-left { flex: 0 1 640px; display: flex; flex-direction: column; align-items: center; }
        .lobby-right { flex: 0 1 300px; text-align: center; }

        .preview-wrapper {
            position: relative; width: 100%; aspect-ratio: 16 / 9;
            background-color: #000; border-radius: 8px; overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }

        #local-preview-container { width: 100%; height: 100%; }

        /* Placeholder / Avatar logic */
        .video-placeholder {
            position: absolute; inset: 0; display: flex;
            justify-content: center; align-items: center;
            font-size: 64px; font-weight: 500; color: white; z-index: 1;
            background: var(--placeholder-bg);
        }

        .video-placeholder .avatar-circle {
            width: 80px; height: 80px; border-radius: 50%;
            background: var(--avatar-bg); display: flex;
            align-items: center; justify-content: center;
            font-size: 40px; color: white;
        }

        .preview-controls-overlay {
            position: absolute; bottom: 16px; left: 50%; transform: translateX(-50%);
            display: flex; gap: 12px; z-index: 10;
        }

        .overlay-btn {
            width: 48px; height: 48px; border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.3); background: rgba(60, 64, 67, 0.6);
            color: white; cursor: pointer; display: flex; align-items: center; justify-content: center;
            font-size: 18px; transition: background 0.2s;
        }

        .overlay-btn.active { background: var(--danger); border-color: transparent; }

        /* Device Selection */
        .device-settings {
            width: 100%; margin-top: 24px; display: grid; grid-template-columns: 1fr 1fr; gap: 16px;
        }
        .device-field { display: flex; flex-direction: column; gap: 4px; }
        .device-field label { font-size: 11px; color: #bdc1c6; font-weight: 500; }
        .device-select {
            background: transparent; color: white; border: 1px solid var(--border-color);
            padding: 8px 12px; border-radius: 4px; font-size: 13px; outline: none; cursor: pointer;
        }

        /* --- JOIN SECTION --- */
        .ready-text { font-size: 28px; font-weight: 400; margin-bottom: 24px; }
        #join-btn {
            background-color: var(--primary-blue); color: #202124; border: none;
            padding: 10px 24px; font-size: 14px; font-weight: 500; border-radius: 20px; cursor: pointer;
        }

        /* --- CALL UI --- */
        #call-container { display: none; height: 100vh; flex-direction: column; position: relative; }
        #video-grid { flex: 1; display: flex; align-items: center; justify-content: center; position: relative; padding: 16px; box-sizing: border-box; }
        .video-player { position: relative; background: #000; border-radius: 8px; overflow: hidden; width: 100%; height: 100%; max-width: 90vw; max-height: 80vh; aspect-ratio: 16 / 9; }
        .controls-bar { height: 80px; display: flex; justify-content: center; align-items: center; gap: 12px; }
        .control-btn { width: 48px; height: 48px; border-radius: 50%; border: none; background: var(--bg-surface); color: white; cursor: pointer; font-size: 18px; }
        .control-btn.active { background: var(--danger); }
        #leave-btn { background: var(--danger); width: 64px; border-radius: 24px; }

        /* Floating Self View */
        .floating-self {
            position: absolute; bottom: 100px; right: 16px;
            width: 240px; aspect-ratio: 16 / 9; border-radius: 8px;
            background: #000; z-index: 100; box-shadow: 0 8px 24px rgba(0,0,0,0.4);
            overflow: hidden; transition: all 0.3s;
        }

        #local-video-wrapper.alone {
            position: relative;
            width: 100%;
            height: 100%;
            max-width: 90vw;
            max-height: 80vh;
            aspect-ratio: 16 / 9;
            bottom: auto;
            right: auto;
            box-shadow: none;
        }

        #local-video-wrapper.alone .avatar-circle {
            width: 200px;
            height: 200px;
            font-size: 100px;
        }

        /* Grid for 3+ users */
        #video-grid.multi {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 16px;
            align-items: stretch;
            justify-items: center;
            max-width: 100%;
        }

        #video-grid.multi.two-users {
            grid-template-columns: 3fr 1fr;
        }

        #video-grid.multi .video-player {
            max-width: none;
            max-height: none;
            aspect-ratio: auto;
        }

        #video-grid.multi .floating-self { display: none; } /* Hide floating in multi */

        .name-label {
            position: absolute;
            bottom: 16px;
            left: 16px;
            background: transparent;
            color: white;
            font-size: 16px;
            font-weight: 400;
            z-index: 2;
        }

        #toast {
            position: absolute;
            bottom: 100px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0,0,0,0.6);
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            display: none;
            z-index: 200;
            font-size: 14px;
        }

        #remote-video-wrapper {
            display: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            /* Lobby Section */
            #lobby-container {
                flex-direction: column;
                gap: 20px;
                padding: 10px;
            }

            .lobby-left, .lobby-right {
                width: 100%;
                flex: none;
            }

            .preview-wrapper {
                aspect-ratio: 4 / 3;
            }

            .device-settings {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .ready-text {
                font-size: 24px;
            }

            #join-btn {
                padding: 12px 32px;
                font-size: 16px;
            }

            /* Call Section */
            #video-grid {
                padding: 8px;
            }

            #video-grid.multi.two-users {
                grid-template-columns: 1fr;
                grid-template-rows: 2fr 1fr;
                gap: 8px;
            }

            .floating-self {
                width: 140px;
                bottom: 90px;
                right: 10px;
            }

            .controls-bar {
                height: 60px;
                gap: 8px;
                padding: 0 10px;
            }

            .control-btn {
                width: 44px;
                height: 44px;
                font-size: 16px;
            }

            #leave-btn {
                width: 56px;
            }

            .name-label {
                font-size: 14px;
                bottom: 8px;
                left: 8px;
            }

            #toast {
                bottom: 80px;
                font-size: 12px;
                padding: 6px 12px;
            }
        }

        @media (max-width: 480px) {
            .preview-wrapper {
                aspect-ratio: 1 / 1;
            }

            .floating-self {
                width: 120px;
                bottom: 70px;
            }

            .controls-bar {
                height: 50px;
            }

            .control-btn {
                width: 40px;
                height: 40px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div id="lobby-container">
        <div class="lobby-left">
            <div class="preview-wrapper">
                <div id="local-preview-container"></div>
                <div id="lobby-placeholder" class="video-placeholder">
                    <div class="avatar-circle"></div>
                </div>
                
                <div class="preview-controls-overlay">
                    <button id="lobby-mic-btn" class="overlay-btn"><i class="fas fa-microphone"></i></button>
                    <button id="lobby-video-btn" class="overlay-btn"><i class="fas fa-video"></i></button>
                </div>
            </div>

            <div class="device-settings">
                <div class="device-field" style="grid-column: span 2;">
                    <label>Camera</label>
                    <select id="cam-list" class="device-select"></select>
                </div>
                <div class="device-field">
                    <label>Microphone</label>
                    <select id="mic-list" class="device-select"></select>
                </div>
                <div class="device-field">
                    <label>Speaker</label>
                    <select id="speaker-list" class="device-select"></select>
                </div>
            </div>
        </div>

        <div class="lobby-right">
            <h1 class="ready-text">Ready to join?</h1>
            <button id="join-btn">Join now</button>
        </div>
    </div>

    <div id="call-container">
        <div id="video-grid">
            <div id="remote-video-wrapper" class="video-player">
                <div id="remote-placeholder" class="video-placeholder">
                    <div class="avatar-circle"></div>
                </div>
                <div class="name-label"></div>
            </div>
            <div id="local-video-wrapper" class="floating-self">
                <div id="local-placeholder" class="video-placeholder">
                    <div class="avatar-circle"></div>
                </div>
                <div class="name-label"></div>
            </div>
        </div>
        <div class="controls-bar">
            <button id="call-mic-btn" class="control-btn"><i class="fas fa-microphone"></i></button>
            <button id="call-video-btn" class="control-btn"><i class="fas fa-video"></i></button>
            <button id="leave-btn" class="control-btn"><i class="fas fa-phone" style="transform: rotate(135deg);"></i></button>
        </div>
        <div id="toast"></div>
    </div>

    <script src="https://download.agora.io/sdk/release/AgoraRTC_N-4.24.1.js"></script>
    <script>
        const options = {
            appId: "<?php echo $app_id; ?>",
            channel: "<?php echo $channel_name; ?>",
            token: "<?php echo $temp_token; ?>",
            uid: Number(<?php echo $uid; ?>),
            localName: "<?php echo addslashes($local_name); ?>",
            remoteName: "<?php echo addslashes($remote_name); ?>"
        };

        const client = AgoraRTC.createClient({ mode: "rtc", codec: "vp8" });
        let localTracks = { videoTrack: null, audioTrack: null };
        let isMicEnabled = true;
        let isVideoEnabled = true;
        let remoteUsers = new Map();
        let isJoined = false;

        function getColorFromName(name) {
            let hash = 0;
            for (let i = 0; i < name.length; i++) hash = name.charCodeAt(i) + ((hash << 5) - hash);
            return `hsl(${Math.abs(hash) % 360}, 50%, 40%)`;
        }

        function togglePlaceholder(id, show) {
            const placeholder = document.getElementById(id);
            placeholder.style.display = show ? 'flex' : 'none';
        }

        function updateVideoElementVisibility(wrapperId, show) {
            const wrapper = document.getElementById(wrapperId);
            const video = wrapper.querySelector('video');
            if (video) video.style.display = show ? 'block' : 'none';
            wrapper.style.backgroundColor = show ? '#000' : getColorFromName(wrapperId.includes('local') ? options.localName : options.remoteName);
        }

        function showToast(message, duration = 3000) {
            const toast = document.getElementById('toast');
            toast.innerText = message;
            toast.style.display = 'block';
            setTimeout(() => { toast.style.display = 'none'; }, duration);
        }

        // Safe play: clear existing videos before playing to avoid black screen / duplicates
        function safePlay(track, containerId) {
            const container = document.getElementById(containerId);
            if (!container) return;
            const videos = container.querySelectorAll('video');
            videos.forEach(v => {
                v.pause();
                v.srcObject = null;
                v.remove();
            });
            track.play(container);
        }

        async function startPreview() {
            localTracks.audioTrack = await AgoraRTC.createMicrophoneAudioTrack();
            localTracks.videoTrack = await AgoraRTC.createCameraVideoTrack();
            safePlay(localTracks.videoTrack, 'local-preview-container');

            const lobbyPlaceholder = document.getElementById('lobby-placeholder');
            lobbyPlaceholder.querySelector('.avatar-circle').innerText = options.localName.charAt(0).toUpperCase();
            lobbyPlaceholder.style.backgroundColor = getColorFromName(options.localName);
            togglePlaceholder('lobby-placeholder', false);
            updateVideoElementVisibility('local-preview-container', true);

            const devices = await AgoraRTC.getDevices();
            ['mic-list', 'cam-list', 'speaker-list'].forEach(selectId => {
                const select = document.getElementById(selectId);
                devices.filter(d => d.kind === (selectId === 'mic-list' ? 'audioinput' : selectId === 'cam-list' ? 'videoinput' : 'audiooutput')).forEach(d => {
                    select.add(new Option(d.label, d.deviceId));
                });
            });
        }

        document.getElementById('mic-list').onchange = (e) => localTracks.audioTrack.setDevice(e.target.value);
        document.getElementById('cam-list').onchange = (e) => localTracks.videoTrack.setDevice(e.target.value);
        document.getElementById('speaker-list').onchange = (e) => AgoraRTC.setPlaybackDevice(e.target.value);

        document.getElementById('join-btn').onclick = async () => {
            document.getElementById('lobby-container').style.display = 'none';
            document.getElementById('call-container').style.display = 'flex';

            await client.join(options.appId, options.channel, options.token, options.uid);
            isJoined = true;

            const localWrapper = document.getElementById('local-video-wrapper');
            localWrapper.classList.add('alone');
            if (isVideoEnabled) safePlay(localTracks.videoTrack, 'local-video-wrapper');

            const localPlaceholder = document.getElementById('local-placeholder');
            localPlaceholder.querySelector('.avatar-circle').innerText = options.localName.charAt(0).toUpperCase();
            localPlaceholder.style.backgroundColor = getColorFromName(options.localName);
            togglePlaceholder('local-placeholder', !isVideoEnabled);
            updateVideoElementVisibility('local-video-wrapper', isVideoEnabled);

            document.querySelector('#local-video-wrapper .name-label').innerText = options.localName;

            const tracksToPublish = [];
            if (localTracks.audioTrack.enabled) tracksToPublish.push(localTracks.audioTrack);
            if (localTracks.videoTrack.enabled) tracksToPublish.push(localTracks.videoTrack);
            if (tracksToPublish.length > 0) await client.publish(tracksToPublish);
            updateLayout();
        };

        // Toggle handlers
        async function handleToggle(type) {
            const isMic = type === 'mic';
            const track = isMic ? localTracks.audioTrack : localTracks.videoTrack;
            const enabled = !track.enabled;

            if (enabled) {
                await track.setEnabled(true);
            } else {
                await track.setEnabled(false);
            }

            if (enabled) {
                if (isJoined) await client.publish(track);
            } else {
                if (isJoined) await client.unpublish(track);
            }

            const btns = [document.getElementById(`lobby-${type}-btn`), document.getElementById(`call-${type}-btn`)];
            btns.forEach(btn => {
                if (btn) {
                    btn.classList.toggle('active', !enabled);
                    btn.innerHTML = enabled ? `<i class="fas fa-${isMic ? 'microphone' : 'video'}"></i>` : `<i class="fas fa-${isMic ? 'microphone-slash' : 'video-slash'}"></i>`;
                }
            });

            if (!isMic) {
                isVideoEnabled = enabled;
                const containerId = isJoined ? 'local-video-wrapper' : 'local-preview-container';
                const placeholderId = isJoined ? 'local-placeholder' : 'lobby-placeholder';
                togglePlaceholder(placeholderId, !enabled);
                updateVideoElementVisibility(containerId, enabled);
                // Remove video when disabling
                if (!enabled) {
                    const container = document.getElementById(containerId);
                    const videos = container.querySelectorAll('video');
                    videos.forEach(v => {
                        v.pause();
                        v.srcObject = null;
                        v.remove();
                    });
                }
                // Safe play when enabling
                if (enabled) {
                    safePlay(localTracks.videoTrack, containerId);
                }
            } else {
                isMicEnabled = enabled;
            }
        }

        document.getElementById('lobby-mic-btn').onclick = () => handleToggle('mic');
        document.getElementById('call-mic-btn').onclick = () => handleToggle('mic');
        document.getElementById('lobby-video-btn').onclick = () => handleToggle('video');
        document.getElementById('call-video-btn').onclick = () => handleToggle('video');

        function createRemoteWrapper(user) {
            let wrapperId;
            const currentCount = remoteUsers.size + 1; // Anticipate the addition
            if (currentCount === 1) {
                wrapperId = 'remote-video-wrapper';
                document.getElementById(wrapperId).style.display = 'block';
                const placeholder = document.getElementById('remote-placeholder');
                placeholder.querySelector('.avatar-circle').innerText = options.remoteName.charAt(0).toUpperCase();
                placeholder.style.backgroundColor = getColorFromName(options.remoteName);
                document.querySelector('#remote-video-wrapper .name-label').innerText = options.remoteName;
            } else {
                const tile = document.createElement("div");
                tile.id = `remote-${user.uid}`;
                tile.className = "video-player";
                const placeholder = document.createElement("div");
                placeholder.id = `remote-placeholder-${user.uid}`;
                placeholder.className = "video-placeholder";
                placeholder.innerHTML = `<div class="avatar-circle">${options.remoteName.charAt(0).toUpperCase()}</div>`;
                placeholder.style.backgroundColor = getColorFromName(options.remoteName);
                tile.appendChild(placeholder);
                const nameLabel = document.createElement('div');
                nameLabel.className = 'name-label';
                nameLabel.innerText = options.remoteName;
                tile.appendChild(nameLabel);
                document.getElementById('video-grid').appendChild(tile);
                wrapperId = tile.id;
            }
            togglePlaceholder(wrapperId === 'remote-video-wrapper' ? 'remote-placeholder' : `remote-placeholder-${user.uid}`, true);
            updateVideoElementVisibility(wrapperId, false);
            return wrapperId;
        }

        client.on("user-joined", (user) => {
            if (!remoteUsers.has(user.uid)) {
                const wrapperId = createRemoteWrapper(user);
                remoteUsers.set(user.uid, { wrapperId, hasVideo: false });
            }
            showToast(`${options.remoteName} joined the meeting`);
            updateLayout();
        });

        client.on("user-published", async (user, mediaType) => {
            await client.subscribe(user, mediaType);
            if (!remoteUsers.has(user.uid)) {
                const wrapperId = createRemoteWrapper(user);
                remoteUsers.set(user.uid, { wrapperId, hasVideo: false });
                updateLayout();
            }
            const userInfo = remoteUsers.get(user.uid);
            if (mediaType === "video") {
                safePlay(user.videoTrack, userInfo.wrapperId);
                togglePlaceholder(userInfo.wrapperId === 'remote-video-wrapper' ? 'remote-placeholder' : `remote-placeholder-${user.uid}`, false);
                updateVideoElementVisibility(userInfo.wrapperId, true);
                userInfo.hasVideo = true;
            }
            if (mediaType === "audio") user.audioTrack.play();
        });

        client.on("user-unpublished", (user, mediaType) => {
            if (mediaType === "video") {
                const userInfo = remoteUsers.get(user.uid);
                if (userInfo && userInfo.hasVideo) {
                    togglePlaceholder(userInfo.wrapperId === 'remote-video-wrapper' ? 'remote-placeholder' : `remote-placeholder-${user.uid}`, true);
                    updateVideoElementVisibility(userInfo.wrapperId, false);
                    userInfo.hasVideo = false;
                }
            }
        });

        client.on("user-left", (user) => {
            const userInfo = remoteUsers.get(user.uid);
            if (userInfo) {
                const wrapperId = userInfo.wrapperId;
                if (wrapperId === 'remote-video-wrapper') {
                    document.getElementById(wrapperId).style.display = 'none';
                } else {
                    document.getElementById(wrapperId).remove();
                }
                remoteUsers.delete(user.uid);
            }
            showToast(`${options.remoteName} left the meeting`);
            updateLayout();
        });

        function updateLayout() {
            const remoteUsersCount = remoteUsers.size;
            const grid = document.getElementById('video-grid');
            const localWrapper = document.getElementById('local-video-wrapper');
            grid.classList.remove('multi');
            grid.classList.remove('two-users');
            localWrapper.classList.remove('video-player');
            localWrapper.classList.remove('alone');
            if (remoteUsersCount >= 1) {
                grid.classList.add('multi');
                localWrapper.classList.remove('floating-self');
                localWrapper.classList.add('video-player');
                if (!grid.contains(localWrapper)) {
                    grid.appendChild(localWrapper);
                }
                if (remoteUsersCount === 1) {
                    grid.classList.add('two-users');
                }
            } else {
                localWrapper.classList.add('alone');
                if (!grid.contains(localWrapper)) {
                    grid.appendChild(localWrapper);
                }
            }
        }

        document.getElementById("leave-btn").onclick = async () => {
            for (let track in localTracks) {
                if (localTracks[track]) {
                    localTracks[track].stop();
                    localTracks[track].close();
                }
            }
            await client.leave();
            isJoined = false;
            document.querySelector('.controls-bar').style.display = 'none';
            showToast('Ending call...');
            window.close();
            setTimeout(() => {
                document.getElementById('call-container').innerHTML 
                = '<div style="height:100vh; display:flex; align-items:center; justify-content:center; flex-direction:column;"><h1>Call Ended</h1><p>You can Re-Join by Refreshing Page.</p></div>';
            }, 100);
        };

        startPreview();
    </script>
</body>
</html>