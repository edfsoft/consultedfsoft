<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo base_url(); ?>assets/edfTitleLogo.png" rel="icon" />
    <title>EDF - Online Consultation</title>
    <!-- bootstrap link -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root{--bg-dark:#ffffff;--bg-surface:#3c4043;--text-primary:#e6e0e0;--danger:#ea4335;--primary-blue:#8ab4f8;--border-color:#5f6368;--placeholder-bg:#00695c;--avatar-bg:#00acc1;}

        body{margin:0;padding:0;font-family:'Google Sans',Roboto,Helvetica,Arial,sans-serif;background-color:var(--bg-dark);color:var(--text-primary);height:100vh;display:flex;flex-direction:column;overflow:hidden;}

        .lobby-header{background:#f8f9fa;padding:16px 24px;text-align:center;border-bottom:1px solid #e0e0e0;color:#202124;}
        .lobby-header h2{margin:0 0 8px 0;font-size:1.5rem;font-weight:500;}
        .lobby-header p{margin:0;font-size:1rem;color:#5f6368;}

        .role-hcp .video-placeholder,.video-player.role-hcp .video-placeholder{background:#00ad8e;}
        .role-cc .video-placeholder,.video-player.role-cc .video-placeholder{background:#0079AD;}
        .role-patient .video-placeholder,.video-player.role-patient .video-placeholder{background:#2F80ED;}

        .avatar-circle{--size:80px;width:var(--size);height:var(--size);border-radius:50%;background:gray !important;color:white;font-size:calc(var(--size)*0.5);font-weight:bold;display:flex;align-items:center;justify-content:center;line-height:1;}

        .header-content{display:flex;align-items:center;justify-content:space-between;max-width:1200px;margin:0 auto;}
        .welcome-text{flex:1;text-align:center;}
        .logo-container img{height:60px;width:auto;}

        #lobby-container{display:flex;flex-direction:column;flex:1;background-color:#ffffff;color:#202124;overflow-y:auto;}
        .lobby-content{flex:1;display:flex;align-items:center;justify-content:center;padding:20px;gap:80px;}
        .lobby-left{flex:0 1 640px;display:flex;flex-direction:column;align-items:center;}
        .lobby-right{flex:0 1 300px;text-align:center;}

        .preview-wrapper{position:relative;width:100%;aspect-ratio:16/9;background-color:#ffffff;border-radius:25px;overflow:hidden;box-shadow:0 4px 6px rgba(0,0,0,0.1);}
        #local-preview-container{width:100%;height:100%;}

        .video-placeholder{position:absolute;inset:0;display:flex;justify-content:center;align-items:center;font-size:64px;font-weight:500;color:white;z-index:1;background:var(--placeholder-bg);border-radius:10px;overflow:hidden;}

        .preview-controls-overlay{position:absolute;bottom:16px;left:50%;transform:translateX(-50%);display:flex;gap:12px;z-index:10;}
        .overlay-btn{width:48px;height:48px;border-radius:50%;border:1px solid rgba(255,255,255,0.3);background:rgba(60,64,67,0.6);color:white;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:18px;transition:background 0.2s;}
        .overlay-btn.active{background:var(--danger);border-color:transparent;}

        .device-settings{width:100%;margin-top:24px;display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;padding:0 10px;}
        .device-field{display:flex;flex-direction:column;gap:4px;}
        #lobby-container .device-field label{color:#5f6368;font-weight:600;}

        #lobby-container .device-select{color:#3c4043;border:1px solid #dadce0;background-color:#ffffff;border-radius:100px;padding:8px 30px 8px 38px;font-size:13px;font-weight:500;width:100%;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;appearance:none;-webkit-appearance:none;cursor:pointer;background-repeat:no-repeat;background-position:left 14px center,right 12px center;background-size:18px 14px;}

        #cam-list{background-image:url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%235f6368' viewBox='0 0 24 24'%3E%3Cpath d='M15 8v8H5V8h10m1-2H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4V7c0-.55-.45-1-1-1z'/%3E%3C/svg%3E"),url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%235f6368' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important;background-position:left 14px center,right 12px center !important;background-size:18px,14px !important;}
        #mic-list{background-image:url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%235f6368' viewBox='0 0 24 24'%3E%3Cpath d='M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3z'/%3E%3Cpath d='M17 11c0 2.76-2.24 5-5 5s-5-2.24-5-5H5c0 3.53 2.61 6.43 6 6.92V21h2v-3.08c3.39-.49 6-3.39 6-6.92h-2z'/%3E%3C/svg%3E"),url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%235f6368' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important;background-position:left 14px center,right 12px center !important;background-size:18px,14px !important;}
        #speaker-list{background-image:url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%235f6368' viewBox='0 0 24 24'%3E%3Cpath d='M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z'/%3E%3C/svg%3E"),url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%235f6368' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important;background-position:left 14px center,right 12px center !important;background-size:18px,14px !important;}

        #join-btn{background-color:#1a73e8;color:#ffffff;border:none;padding:18px 48px;font-size:14px;font-weight:500;border-radius:25px;cursor:pointer;transition:background-color 0.2s,box-shadow 0.2s;box-shadow:0 1px 2px 0 rgba(60,64,67,0.3),0 1px 3px 1px rgba(60,64,67,0.15);}
        #join-btn:hover{background-color:#8ab4f8;color:#202124;box-shadow:0 1px 3px 0 rgba(60,64,67,0.3),0 4px 8px 3px rgba(60,64,67,0.15);}
        #join-btn:active{background-color:#1765cc;}

        #call-container{display:none;height:100vh;flex-direction:column;position:relative;}
        #video-grid{flex:1;display:flex;align-items:center;justify-content:center;position:relative;padding:20px;box-sizing:border-box;background-color:#ffffff;}

        .video-player{position:relative;background:transparent;border-radius:11px;overflow:hidden;width:100%;height:100%;max-width:100%;max-height:100%;aspect-ratio:16/9;}
        .controls-bar{height:80px;display:flex;justify-content:center;align-items:center;gap:12px;}
        .control-btn{width:48px;height:48px;border-radius:50%;border:none;background:var(--bg-surface);color:white;cursor:pointer;font-size:18px;}
        .control-btn.active{background:var(--danger);}
        #leave-btn{background:var(--danger);width:64px;border-radius:24px;}

        .floating-self{position:absolute;bottom:100px;right:16px;width:240px;aspect-ratio:16/9;border-radius:8px;background:#ffffff;z-index:100;box-shadow:0 8px 24px rgba(0,0,0,0.4);overflow:hidden;}
        #player-local.alone{position:relative;width:100%;height:100%;max-width:90vw;max-height:80vh;aspect-ratio:16/9;bottom:auto;right:auto;box-shadow:none;}
        #player-local.alone .avatar-circle{--size:200px;font-size:calc(var(--size)*0.5);}

        #video-grid.two-users{flex-direction:row;align-items:stretch;justify-content:space-between;gap:16px;padding:20px;height:calc(100% - 40px);}
        #video-grid.two-users .video-player{flex:1 1 50%;height:100%;aspect-ratio:auto;max-height:none;border-radius:12px;overflow:hidden;}
        #video-grid.two-users #player-local{flex:0 0 300px !important;max-width:300px !important;order:2;}
        #video-grid.two-users .video-player:not(#player-local){order:1;}

        #video-grid.multi{display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:16px;align-items:stretch;justify-items:center;max-width:100%;padding:20px;}
        #video-grid.multi .video-player{max-width:none;max-height:none;aspect-ratio:auto;}

        .name-label{position:absolute;bottom:8px;left:8px;background:rgba(0,0,0,0.4);box-shadow:0 2px 4px rgba(0,0,0,0.3);backdrop-filter:blur(4px);color:white;padding:4px 12px;border-radius:4px;font-size:14px;font-weight:500;z-index:2;pointer-events:none;}

        #toast{position:fixed;top:40px;right:40px;left:auto;transform:none;background:rgba(0,0,0,0.75);color:white;padding:10px 18px;border-radius:8px;box-shadow:0 4px 12px rgba(0,0,0,0.3);display:none;z-index:1000;font-size:14px;max-width:320px;text-align:left;pointer-events:none;opacity:0;transition:opacity 0.3s ease;}
        #toast[style*="block"]{opacity:1;}

        @media (max-width:768px){
            .lobby-content{flex-direction:column;gap:20px;padding:10px;}
            .lobby-left,.lobby-right{width:100%;flex:none;}
            .preview-wrapper{aspect-ratio:4/3;}
            .device-settings{grid-template-columns:1fr;gap:12px;}
            .lobby-header h2{font-size:1.3rem;}
            .lobby-header p{font-size:0.95rem;}
            #video-grid{padding:16px;}
            .floating-self{width:140px;bottom:90px;right:10px;}
            .controls-bar{height:60px;gap:8px;padding:0 10px;}
            .control-btn{width:44px;height:44px;font-size:16px;}
            #leave-btn{width:56px;}
            #video-grid.two-users{flex-direction:column;gap:12px;padding:16px;height:100%;}
            #video-grid.two-users .video-player{flex:1 1 auto;max-width:100%;height:48%;aspect-ratio:4/3;}
            #video-grid.two-users #player-local{flex:0 0 35% !important;max-height:35% !important;}
            #toast{top:30px;right:20px;font-size:13px;padding:8px 14px;max-width:280px;}
        }

        @media (max-width:480px){
            .preview-wrapper{aspect-ratio:1/1;}
            .floating-self{width:120px;bottom:70px;}
            .controls-bar{height:50px;}
            .control-btn{width:40px;height:40px;font-size:14px;}
            #video-grid{padding:12px;}
        }
    </style>
</head>
<body data-role="<?php echo $role ?: 'patient'; ?>">

    <div id="lobby-container">

        <!-- Welcome message -->
       <div class="lobby-header">
    <div class="header-content">
        <div class="logo-container">
            <a href="https://erodediabetesfoundation.org/" target="_blank" class="logo">
                <img src="<?php echo base_url(); ?>assets/edf_logo.png" alt="EDF Logo" />
            </a>
        </div>

        <div class="welcome-text">
            <h2>Welcome to Online Consultation</h2>
            <p>Make your consultation through this secure online portal.<br>
            Press the <strong>Join</strong> button below to enter the meeting.</p>
        </div>

        <div style="width: 180px; visibility: hidden;" class="d-none d-md-block"></div>
    </div>
</div>

        <div class="lobby-content">
            <div class="lobby-left">
                <div class="preview-wrapper">
                    <div id="local-preview-container"></div>
                    <div id="lobby-placeholder" class="video-placeholder" style="border-radius: 20px;">
                        <div class="avatar-circle"></div>
                    </div>
                    
                    <div class="preview-controls-overlay">
                        <button id="lobby-mic-btn" class="overlay-btn"><i class="fas fa-microphone"></i></button>
                        <button id="lobby-video-btn" class="overlay-btn"><i class="fas fa-video"></i></button>
                    </div>
                </div>

                <div class="device-settings">
                    <div class="device-field">
                        <select id="cam-list" class="device-select"></select>
                    </div>
                    <div class="device-field">
                        <select id="mic-list" class="device-select"></select>
                    </div>
                    <div class="device-field">
                        <select id="speaker-list" class="device-select"></select>
                    </div>
                </div>
            </div>

            <div class="lobby-right">
                <h1 class="ready-text">Ready to join?</h1>
                <button id="join-btn">Join now</button>
            </div>
        </div>
    </div>
</div>
    <div id="call-container">
        <div id="video-grid">
            <div id="player-local" class="floating-self">
                <div id="placeholder-local" class="video-placeholder">
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
            uid: Number(<?php echo $uid ?: 0; ?>),
            localName: "<?php echo addslashes($local_name ?: 'Guest'); ?>",
            patientName: "<?php echo addslashes($patient_name ?: 'Patient'); ?>",
            hcpName: "<?php echo addslashes($hcp_name ?: 'Doctor'); ?>",
            chiefName: "<?php echo addslashes($chief_name ?: 'Chief Doctor'); ?>",
            role: "<?php echo $role ?: 'patient'; ?>"
        };

        const isDoctor = <?php echo $is_doctor ? 'true' : 'false'; ?>;

        const client = AgoraRTC.createClient({ mode: "rtc", codec: "vp8" });
        let localTracks = { videoTrack: null, audioTrack: null };
        let isMicEnabled = true;
        let isVideoEnabled = true;
        let remoteUsers = new Map();
        let isJoined = false;

        function getDisplayName(name, role) {
            let prefix = role === 'patient' ? '' : 'Dr. ';
            let suffix = '';
            if (role === 'hcp') suffix = ' (HCP)';
            if (role === 'cc') suffix = ' (CC)';
            if (role === 'patient') suffix = ' (Patient)';
            return prefix + name + suffix;
        }

        function getRoleFromUid(uid) {
            if (uid >= 100000 && uid < 200000) return 'patient';
            if (uid >= 200000 && uid < 300000) return 'hcp';
            if (uid >= 300000 && uid < 400000) return 'cc';
            return 'unknown';
        }

        function getUserName(uid) {
            const role = getRoleFromUid(uid);
            let name = 'Unknown';

            if (role === 'patient') name = options.patientName;
            else if (role === 'hcp') name = options.hcpName;
            else if (role === 'cc') name = options.chiefName;

            return (name && name.trim() !== "") ? name : (role.toUpperCase());
        }

        function togglePlaceholder(id, show) {
            const placeholder = document.getElementById(id);
            if(placeholder) placeholder.style.display = show ? 'flex' : 'none';
        }

        function showToast(message, duration = 3000) {
            const toast = document.getElementById('toast');
            toast.innerText = message;
            toast.style.display = 'block';
            setTimeout(() => { toast.style.display = 'none'; }, duration);
        }

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

        function createRemoteWrapper(uid, name, role) {
            const player = document.createElement('div');
            player.className = 'video-player';
            player.id = `player-${uid}`;
            player.classList.add(`role-${role}`);

            const placeholder = document.createElement('div');
            placeholder.id = `placeholder-${uid}`;
            placeholder.className = 'video-placeholder';

            const avatar = document.createElement('div');
            avatar.className = 'avatar-circle';
            let initial = (name && name.length > 0) ? name.charAt(0).toUpperCase() : '?';
            avatar.innerText = initial;
            
            placeholder.appendChild(avatar);

            const nameLabel = document.createElement('div');
            nameLabel.className = 'name-label';
            nameLabel.innerText = getDisplayName(name, role);

            player.appendChild(placeholder);
            player.appendChild(nameLabel);

            document.getElementById('video-grid').appendChild(player);

            return `player-${uid}`;
        }

        async function handleToggle(type) {
            const isMic = type === 'mic';
            const track = isMic ? localTracks.audioTrack : localTracks.videoTrack;
            if (!track) return;
            const enabled = !track.enabled;
            await track.setEnabled(enabled);
            if (isJoined) {
                if (enabled) {
                    await client.publish(track);
                } else {
                    await client.unpublish(track);
                }
            }

            const btns = [document.getElementById(`lobby-${type}-btn`), document.getElementById(`call-${type}-btn`)];
            btns.forEach(btn => {
                if (btn) {
                    btn.classList.toggle('active', !enabled);
                    btn.innerHTML = `<i class="fas fa-${isMic ? 'microphone' : 'video'}${!enabled ? '-slash' : ''}"></i>`;
                }
            });

            if (!isMic) {
                isVideoEnabled = enabled;
                const containerId = isJoined ? 'player-local' : 'local-preview-container';
                const placeholderId = isJoined ? 'placeholder-local' : 'lobby-placeholder';
                togglePlaceholder(placeholderId, !enabled);
                if (!enabled) {
                    const container = document.getElementById(containerId);
                    const videos = container.querySelectorAll('video');
                    videos.forEach(v => {
                        v.pause();
                        v.srcObject = null;
                        v.remove();
                    });
                } else {
                    safePlay(localTracks.videoTrack, containerId);
                }
            } else {
                isMicEnabled = enabled;
            }
        }

        function updateLayout() {
            const videoGrid = document.getElementById('video-grid');
            const localPlayer = document.getElementById('player-local');
            const numRemotes = remoteUsers.size;
            const total = numRemotes + 1;

            videoGrid.classList.remove('multi', 'two-users');
            localPlayer.classList.remove('alone', 'floating-self', 'video-player');

            if (total === 1) {
                localPlayer.classList.add('alone');
                localPlayer.classList.add('floating-self');
            } 
            else if (total === 2) {
                videoGrid.classList.add('two-users');
                localPlayer.classList.add('video-player');
                localPlayer.classList.remove('floating-self');
            } 
            else {
                videoGrid.classList.add('multi');
                localPlayer.classList.add('video-player');
            }
        }

        async function startPreview() {
            localTracks.audioTrack = await AgoraRTC.createMicrophoneAudioTrack();
            localTracks.videoTrack = await AgoraRTC.createCameraVideoTrack();
            safePlay(localTracks.videoTrack, 'local-preview-container');

            let localInitial = (options.localName && options.localName.length > 0) ? options.localName.charAt(0).toUpperCase() : '?';

            const lobbyPlaceholder = document.querySelector('#lobby-placeholder');
            lobbyPlaceholder.querySelector('.avatar-circle').innerText = localInitial;
            lobbyPlaceholder.parentElement.classList.add(`role-${options.role}`); 
            lobbyPlaceholder.classList.add(`role-${options.role}`); 
            document.querySelector('.lobby-left').classList.add(`role-${options.role}`);

            togglePlaceholder('lobby-placeholder', false);

            document.querySelector('#placeholder-local .avatar-circle').innerText = localInitial;
            document.querySelector('#player-local .name-label').innerText = getDisplayName(options.localName, options.role);
            document.getElementById('player-local').classList.add(`role-${options.role}`);

            const devices = await AgoraRTC.getDevices();
            ['mic-list', 'cam-list', 'speaker-list'].forEach(selectId => {
                const select = document.getElementById(selectId);
                devices.filter(d => d.kind === (selectId === 'mic-list' ? 'audioinput' : selectId === 'cam-list' ? 'videoinput' : 'audiooutput')).forEach(d => {
                    select.add(new Option(d.label, d.deviceId));
                });
            });
        }

        document.getElementById('mic-list').onchange = (e) => { if (localTracks.audioTrack) localTracks.audioTrack.setDevice(e.target.value); };
        document.getElementById('cam-list').onchange = (e) => { if (localTracks.videoTrack) localTracks.videoTrack.setDevice(e.target.value); };
        document.getElementById('speaker-list').onchange = (e) => AgoraRTC.setPlaybackDevice(e.target.value);

        document.getElementById('lobby-mic-btn').onclick = () => handleToggle('mic');
        document.getElementById('call-mic-btn').onclick = () => handleToggle('mic');
        document.getElementById('lobby-video-btn').onclick = () => handleToggle('video');
        document.getElementById('call-video-btn').onclick = () => handleToggle('video');
        
        document.getElementById('join-btn').onclick = async () => {
            document.getElementById('lobby-container').style.display = 'none';
            document.getElementById('call-container').style.display = 'flex';
            updateLayout();
            await client.join(options.appId, options.channel, options.token, options.uid);
            isJoined = true;

            const tracksToPublish = [];
            if (localTracks.audioTrack && localTracks.audioTrack.enabled) tracksToPublish.push(localTracks.audioTrack);
            if (localTracks.videoTrack && localTracks.videoTrack.enabled) tracksToPublish.push(localTracks.videoTrack);
            if (tracksToPublish.length > 0) await client.publish(tracksToPublish);
            
            if (localTracks.videoTrack && localTracks.videoTrack.enabled) {
                safePlay(localTracks.videoTrack, 'player-local');
                togglePlaceholder('placeholder-local', false);
            } else {
                togglePlaceholder('placeholder-local', true);
            }

            document.getElementById('call-mic-btn').classList.toggle('active', !localTracks.audioTrack.enabled);
            document.getElementById('call-mic-btn').innerHTML = `<i class="fas fa-microphone${!localTracks.audioTrack.enabled ? '-slash' : ''}"></i>`;
            document.getElementById('call-video-btn').classList.toggle('active', !localTracks.videoTrack.enabled);
            document.getElementById('call-video-btn').innerHTML = `<i class="fas fa-video${!localTracks.videoTrack.enabled ? '-slash' : ''}"></i>`;
            
            for (const user of client.remoteUsers) {
                const uid = user.uid;
                if (!remoteUsers.has(uid)) {
                    const role = getRoleFromUid(uid);
                    const name = getUserName(uid);
                    const wrapperId = createRemoteWrapper(uid, name, role);
                    remoteUsers.set(uid, { wrapperId, hasVideo: false });
                    showToast(`${getDisplayName(name, role)} is already in the meeting`);
                }
                const userInfo = remoteUsers.get(uid);
                if (user.hasVideo) {
                    await client.subscribe(user, "video");
                    safePlay(user.videoTrack, userInfo.wrapperId);
                    togglePlaceholder(`placeholder-${uid}`, false);
                    userInfo.hasVideo = true;
                }
                if (user.hasAudio) {
                    await client.subscribe(user, "audio");
                    user.audioTrack.play();
                }
            }

            updateLayout();
        };

        client.on("user-joined", (user) => {
            const uid = user.uid;
            if (!remoteUsers.has(uid)) {
                const role = getRoleFromUid(uid);
                const name = getUserName(uid);
                const wrapperId = createRemoteWrapper(uid, name, role);
                remoteUsers.set(uid, { wrapperId, hasVideo: false });
                showToast(`${getDisplayName(name, role)} joined the meeting`);
                updateLayout();
            }
        });

        client.on("user-published", async (user, mediaType) => {
            const uid = user.uid;
            await client.subscribe(user, mediaType);
            if (!remoteUsers.has(uid)) {
                const role = getRoleFromUid(uid);
                const name = getUserName(uid);
                const wrapperId = createRemoteWrapper(uid, name, role);
                remoteUsers.set(uid, { wrapperId, hasVideo: false });
                showToast(`${getDisplayName(name, role)} joined the meeting`);
                updateLayout();
            }
            const userInfo = remoteUsers.get(uid);
            if (mediaType === "video") {
                safePlay(user.videoTrack, userInfo.wrapperId);
                togglePlaceholder(`placeholder-${uid}`, false);
                userInfo.hasVideo = true;
            }
            if (mediaType === "audio") user.audioTrack.play();
        });

        client.on("user-unpublished", (user, mediaType) => {
            if (mediaType === "video") {
                const userInfo = remoteUsers.get(user.uid);
                if (userInfo && userInfo.hasVideo) {
                    togglePlaceholder(`placeholder-${user.uid}`, true);
                    userInfo.hasVideo = false;
                }
            }
        });

        client.on("user-left", (user) => {
            const userInfo = remoteUsers.get(user.uid);
            if (userInfo) {
                document.getElementById(userInfo.wrapperId).remove();
                remoteUsers.delete(user.uid);
            }
            const name = getUserName(user.uid);
            const role = getRoleFromUid(user.uid);
            showToast(`${getDisplayName(name, role)} left the meeting`);
            updateLayout();
        });

        document.getElementById("leave-btn").onclick = async () => {
            for (let track in localTracks) {
                if (localTracks[track]) {
                    localTracks[track].stop();
                    localTracks[track].close();
                }
            }

            await client.leave();
            isJoined = false;
            showToast('Ending call...');

            if (options.role === 'patient') {
                window.close();

                setTimeout(() => {
                    if (!window.closed) {
                        document.getElementById('call-container').innerHTML = 
                            '<div style="height:100vh; display:flex; align-items:center; justify-content:center; flex-direction:column; color:#333; background:#fff;">' +
                            '<h1>Call Ended</h1>' +
                            '<p style="font-size:18px; margin:20px 0;">You can now safely close this browser tab.</p>' +
                            '<p style="color:#666;">(Some browsers block auto-closing — close it manually)</p>' +
                            '</div>';
                    }
                }, 500);
            } 
            else if (options.role === 'cc') {
                window.location.href = "<?php echo base_url('Chiefconsultant/appointments'); ?>";
            } 
            else if (options.role === 'hcp') {
                let endHtml = '<div style="height:100vh; display:flex; align-items:center; justify-content:center; flex-direction:column; background-color:#ffffff; color:#000000;">';
                endHtml += '<h1 style="margin-bottom:20px; font-weight:600;">Call Ended</h1>';
                endHtml += '<button onclick="window.close(); window.location.href=\'<?php echo base_url('healthcareprovider/appointments'); ?>\'" class="home-btn" style="background-color:#28a745; color:#ffffff; padding:14px 32px; font-size:18px; border:none; border-radius:8px; cursor:pointer; font-weight:500; transition: background-color 0.2s;"> close and Back to Appointments</button>';
                endHtml += '<p style="margin-top:16px; font-size:14px; color:#5f6368;">(This tab will close and return you to your dashboard)</p>';
                endHtml += '</div>';
                document.getElementById('call-container').innerHTML = endHtml;
            } else {
                window.close();
            }
        };

        startPreview();
    </script>
</body>
</html>