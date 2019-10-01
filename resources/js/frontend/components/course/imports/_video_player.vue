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
        poster: { type: String, required: false },
        sources: {
            type: Array,
            default() {
                return [];
            }
        },
        next_url: { type: String },
        content_type: { type: String, default: 'youtube' }
    },

    data(){
        return {
            player: null,
            playerOptions:{
                muted: false,
                autoplay: true,
                language: 'en',
                fluid: true,
                responsive: true,
                techOrder: ['html5', 'youtube'],
                playbackRates: [0.5, 1, 1.5, 2],
                sources: [],
                poster: "",
                controls: false,
                youtube: {
                    ytControls: 2,
                    customVars: { 
                        wmode: 'transparent' 
                    }
                }
            }
        }
    },

    methods: {
        
    },


    beforeMount(){
        if(this.content_type !== 'youtube') this.playerOptions.controls=true
        this.playerOptions.poster = this.poster
        this.playerOptions.sources = this.sources
    },

    async mounted() {
        this.player = await videojs(this.$refs.videoPlayer, this.playerOptions, function onPlayerReady() {
            console.log('ready')
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
