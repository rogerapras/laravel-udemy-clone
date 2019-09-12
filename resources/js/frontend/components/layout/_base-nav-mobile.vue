<template>
    <div>
        <div class="navbar navbar-expand-lg navbar-light p-0 gabs__main_nav">
            <div class="nav_inner d-flex align-items-center justify-content-between">
                <!-- Search and expand icons for mobile only -->
                <div class="nav__mob_icons">
                    <a href="#mobileMenu">
                        <div class="bars">
                            <i class="fa fa-bars font-30 font-weight-bold"></i>
                        </div>
                    </a>
                </div>
                
                
                <a class="navbar-brand logo__wrap mr-0" href="#">
                    <img src="https://www.udemy.com/staticx/udemy/images/v6/logo-coral.svg" class=img-responsive />
                </a>
                
                <div class="search_icon">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="#" role="button" @click.prevent="showSearch=!showSearch">
                            <i class="fa fa-search font-25" v-if="!showSearch"></i>
                            <i class="fa fa-times-circle font-25" v-else></i>
                        </a>
                        <a href="javascript:void(0)" class="gabs__dropdown-toggle gabs__hover_grey" role="button">
                            <div class="fx pos-r text-center">
                                <span class="fa fa-shopping-cart dropdown__main_icon gicon font-25"></span>
                                <sup><span class="badge badge-pill badge-danger">1</span></sup>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <transition name="slidedown">
            <form class="form-inline mt-2 mob-form" v-if="showSearch">
                <input class="form-control form-control-lg rounded-0" type="search" placeholder="Search for Courses" aria-label="Search">
                <button class="btn btn-outline-success search-icon" type="submit">
                    <i class="fa fa-search"></i>
                </button> 
            </form> 
        </transition>
        
        <!-- The menu -->
          <nav id="mobileMenu">
             <ul>
                <li v-if="user">
                    <a href="/" >
                        <div class="d-flex align-items-center">
                            <div class="mr-2">
                                <img src="https://udemy-images.udemy.com/user/50x50/4914554_7ee3_2.jpg"
                                    class="rounded-circle"/>
                            </div>
                            <div class="mob_user_meta d-flex">
                                <span class="fx">
                                    <span class="text-midnight ellipsis">{{ trans('strings.hi_user', [user.full_name]) }}</span>
                                </span>
                            </div>
                        </div>
                    </a>
                    <ul>
                        <li><a href="#">{{ trans('strings.notifications') }}</a></li>
                        <li><a href="#">{{ trans('strings.messages') }}</a></li>
                        <li><a href="#">{{ trans('strings.wishlist') }}</a></li>
                        <li><a href="#">{{ trans('strings.public_profile') }}</a></li>
                        <li><a href="#">{{ trans('strings.edit_profile') }}</a></li>
                    </ul>
                </li>
                <li><a href="/">{{ trans('strings.home') }}</a></li>
                <li>
                    <a href="/categories">{{ trans('strings.categories') }}</a>
                    <ul>
                        <li v-for="category in categories" :key="category.uuid">
                            <a href="#"><i :class="category.image"></i> {{ category.name }}</a>
                            <ul>
                                <li>
                                    <a href="#" class="font-weight-bold">{{ trans('strings.all_in_category', {category: category.name}) }}</a>
                                </li>
                                <li v-for="child in category.children" :key="child.id">
                                    <a href="#">{{ child.name }}</a>
                                </li>
                            </ul>
                        </li>
                   </ul>
                </li>
                <template v-if="user">
                    <li><a href="#">{{ trans('strings.my_courses') }}</a></li>
                    <li><a href="#">{{ trans('strings.instructor') }}</a></li>
                    <li><a href="#">{{ trans('strings.logout') }}</a></li>
                </template>
                <template v-else>
                    <li><a href="#">{{ trans('strings.register') }}</a></li>
                    <li><a href="#">{{ trans('strings.login') }}</a></li>
                </template>
                
             </ul>
          </nav>
    </div>
</template>

<script>
import Mmenu from 'mmenu-js'
export default {
    props:['categories', 'user'],
    data(){
        return {
            showSearch: false
        }    
    },
    
    mounted(){

        new Mmenu("#mobileMenu", {
            "extensions": [
                "position-front",
                "theme-white",
                "pagedim-black",
                "shadow-page",
                "fx-panels-slide-100",
            ],
            "navbars": [
                {
                    "position": "top",
                    "content": [
                        "next",
                        "close"
                    ]
                }
            ]
        })
    }
}
</script>
