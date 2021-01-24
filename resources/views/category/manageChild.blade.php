<ul>

    @foreach($childs as $child)

        <li>

            {{ $child->title }}
           
             <a  onclick="moduleView({{ $child->id }})"><span class="badge badge-pill badge-primary">View</span></a>
                                <a onclick="deletemod({{ $child->id }})"  id="deletemodule"><span class="badge badge-pill badge-danger">Delete</span></a>

            @if(count($child->childs))

                @include('category.manageChild',['childs' => $child->childs])

            @endif

        </li>

    @endforeach

</ul>
<script type="text/javascript">
     function moduleView(id)
     {

        window.location.href="{{ url('gettestcase') }}/"+id;
     }

 </script>
  <script type="text/javascript">
     function deletemod(id)
     {

        window.location.href="{{ url('deletemodule') }}/"+id;
     }

 </script>