<ul class="list-group menu rounded m-3 ">
    <li class="list-group-item">
        <a href="{{route('admin.resource')}}" class="btn m-0 p-0">课程资源</a>
    </li>
    <li class="list-group-item">
        <a href="{{route('admin.resource.add',['type'=>App\Models\Resource::VIDEO])}}" class="btn m-0 p-0">添加视频</a>
    </li>

    <li class="list-group-item">
        <a class='btn m-0 p-0' href='{{ route("admin.resource.add", ["type"=>App\Models\Resource::DOC])}}'>添加文档</a>
    </li>
</ul>
