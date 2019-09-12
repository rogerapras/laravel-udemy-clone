<template>
    <div class="row">
      <div class="col-md-12 p-0 cards__carousel">
          <slick
            ref="slick"
            :options="slickOptions"
            @afterChange="handleAfterChange"
            @beforeChange="handleBeforeChange"
            @breakpoint="handleBreakpoint"
            @destroy="handleDestroy"
            @edge="handleEdge"
            @init="handleInit"
            @reInit="handleReInit"
            @setPosition="handleSetPosition"
            @swipe="handleSwipe"
            @lazyLoaded="handleLazyLoaded"
            @lazyLoadError="handleLazeLoadError">
              <CourseCardSlick />
              <CourseCardSlick />
              <CourseCardSlick />
              <CourseCardSlick />
              <CourseCardSlick />
              <CourseCardSlick />
              <CourseCardSlick />
      		  
          </slick>
        </div>
    </div>
</template>

<script>
    
    //import Slick from 'vue-slick'
    import CourseCardSlick from './imports/CourseCardSlick'
    import { mapGetters } from 'vuex'
    
    export default{
        name: 'SlickCarousel',
        components: {
            Slick: () => import('vue-slick'),
            CourseCardSlick
        },
        
        props: {
            num_slides: { type: Number, default: 5 }
        },
        
        data() {
          return {
            slickOptions: {
                slidesToShow: this.num_slides,
                dots: false,
                infinite: false,
                responsive: [
                  {
                      breakpoint: 1300,
                      settings: {
                          slidesToShow: 5,
                          slidesToScroll: 5,
                      }
                  },
                  {
                      breakpoint: 1100,
                      settings: {
                          slidesToShow: 4,
                          slidesToScroll: 4
                      }
                  },
                  {
                      breakpoint: 840,
                      settings: {
                          slidesToShow: 3,
                          slidesToScroll: 3
                      }
                  },
                  {
                      breakpoint: 620,
                      settings: {
                          slidesToShow: 1,
                          slidesToScroll: 1
                      }
                  },
                  {
                      breakpoint: 480,
                      settings: {
                          slidesToShow: 1,
                          slidesToScroll: 1
                      }
                  }
              ]
            }
          }
        },
      
        methods: {
            next() {
                this.$refs.slick.next();
            },
        
            prev() {
                this.$refs.slick.prev();
            },
        
            reInit() {
                // Helpful if you have to deal with v-for to update dynamic lists
                this.$nextTick(() => {
                    this.$refs.slick.reSlick();
                });
            },
        
            // Events listeners
            handleAfterChange(event, slick, currentSlide) {
                //console.log('handleAfterChange', event, slick, currentSlide);
            },
            handleBeforeChange(event, slick, currentSlide, nextSlide) {
                //console.log('handleBeforeChange', event, slick, currentSlide, nextSlide);
            },
            handleBreakpoint(event, slick, breakpoint) {
                //console.log('handleBreakpoint', event, slick, breakpoint);
            },
            handleDestroy(event, slick) {
                //console.log('handleDestroy', event, slick);
            },
            handleEdge(event, slick, direction) {
                //console.log('handleEdge', event, slick, direction);
            },
            handleInit(event, slick) {
                //console.log('handleInit', event, slick);
            },
            handleReInit(event, slick) {
                //console.log('handleReInit', event, slick);
            },
            handleSetPosition(event, slick) {
                //console.log('handleSetPosition', event, slick);
            },
            handleSwipe(event, slick, direction) {
                //console.log('handleSwipe', event, slick, direction);
            },
            
            handleLazyLoaded(event, slick, image, imageSource) {
                //console.log('handleLazyLoaded', event, slick, image, imageSource);
            },
            
            handleLazeLoadError(event, slick, image, imageSource) {
                //console.log('handleLazeLoadError', event, slick, image, imageSource);
            }
        
        },
    
        created(){
            this.slickOptions.slidesToShow = this.num_slides
        }
        
    }
</script>