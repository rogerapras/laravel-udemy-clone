
<template>
    <div class="video-js-responsive-containerx vjs-hdx video-border vjs-16-9">
        <video autoplay ref="videoPlayer" class="video-js"></video>
    </div>
</template>

<script>
import videojs from 'video.js';
import youtube from 'videojs-youtube';
export default {
    name: "VideoPlayer",
    props: {
        options: {
            type: Object,
            default() {
                return {};
            }
        },
        next_url: { type: String }
    },
    data() {
        return {
            player: null
        }
    },
    async mounted() {
        this.player = await videojs(this.$refs.videoPlayer, this.options, function onPlayerReady() {
            //this.player.play()
        }).on('ended', () => {
            if(this.next_url){
                setTimeout(() => {
                    window.location.href= this.next_url
                }, 2000)
            }
        })
    },
    beforeDestroy() {
        if (this.player) {
            this.player.dispose()
        }
    }
}
</script>

<style scoped>
    .video-border{
        border: 5px solid #6c757d85;
    }
</style>
