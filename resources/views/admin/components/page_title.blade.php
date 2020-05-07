<div class="row mt-2 mb-2">
    <div class="col-12">
        <!-- d-flex布局一左一右排列  -->
        <div class="d-flex mb-2" style="margin-top:auto">
            <h3 class="m-0 p-0">{{$title}}</h3>
            <small class="text-muted mr-auto pl-2" style="margin-top:auto">{{$conment}}</small>
            {{$slot}}
        </div>
    </div>
</div>