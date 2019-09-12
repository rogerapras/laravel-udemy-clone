<template>
    <div class="webui-popover-content__inner d-flex flex-column p-2">
        <div class="pop__updated_at mb-2">
            last_updated: 11/2018
        </div>
        <div class="pop__course_title fw-600 mb-1">
            <a href="#" class="font-18">
                This is the course title...
            </a>
        </div>
        
        <div class="pop__category_sm mb-2">
            <!-- <span class="bestseller-badge badge-accented yellow">bestseller</span> -->
            <span class="context_info">
                in <a href="#">Penetration testing</a> | IT & Software
            </span>
        </div>
        
        <div class="pop__stats font-12 d-flex mb-3">
            <div class="mr-1">
                <i class="fa fa-play-circle"></i> 123 lectures
            </div>
            <div class="mr-1">
                <i class="fa fa-clock-o"></i> 42 hours
            </div>
            <div class="mr-1">
                <i class="fa fa-thermometer-half"></i> All Levels
            </div>
            <div class="mr-1">
                <i class="fa fa-globe"></i> English
            </div>
        </div>
        
        <div class="pop__course_description mb-4 font-13">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras non lacinia nulla. Curabitur lacus est, consectetur aliquam consequat non, varius sit amet nibh. Suspendisse ut vulputate mi. Suspendisse tincidunt sodales felis vitae viverra.
            </p>
            <p>
                <ul>
                    <li>Learn objective 1</li>
                    <li>Learn objective 2</li>
                    <li>Learn objective 3</li>
                    <li>Learn objective 4</li>
                </ul>
            </p>
        </div>
    
        <div class="d-flex mt-auto">
            <div class="w-100">
               <button class="btn btn-lg rounded-0 btn-danger">add-to-cart</button>
            </div>
            <div class="flex-shrink-1 ml-4 align-self-center text-center">
                <a href="#" class="text-danger">
                    <i class="fa fa-heart-o fa-2x"></i>
                </a>
            </div>
        </div>
    </div>
</template>