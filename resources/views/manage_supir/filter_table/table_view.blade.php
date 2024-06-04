<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@foreach($users as $user)
<tr>
  <td>
  	<img src="{{ asset('pictures/' . $user->foto) }}">
  	<span class="ml-2">{{ $user->nama }}</span>
  </td>
  <td>{{ $user->email }}</td>
  <td>
    @if($user->role == 'admin')
    <span class="btn admin-span">{{ $user->role }}</span>
    @else
    <span class="btn kasir-span">{{ $user->role }}</span>
    @endif
  </td>
  <td>
  	<button type="button" class="btn btn-icons btn-rounded btn-secondary">
        {{-- <i class="mdi mdi-pencil"></i> --}}
        <i class="fa-solid fa-pen-nib"></i>
    </button>
    <button type="button" class="btn btn-icons btn-rounded btn-secondary ml-1">
        {{-- <i class="mdi mdi-close"></i> --}}
        <i class="fa-solid fa-trash"></i>
    </button>
  </td>
</tr>
@endforeach