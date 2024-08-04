 <!-- Add -->
 <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header" id="mheader">
         <h5 class="modal-title">Add New User / Incharge</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
         @csrf
         <div class="modal-body">
           @if ($page ?? false)
             <input type="hidden" name="incharge" value="incharge">
           @endif
           <label for="image">Image</label>
           <input type="file" class="form-control" name="image" id="image" />
           <label for="first_name">First name</label>
           <input type="text" class="form-control" name="first_name" id="first_name" />
           <label for="last_name">Last name</label>
           <input type="text" class="form-control" name="last_name" id="last_name" />
           <label for="gender">Gender</label>
           <select id="gender" class="form-control" name="gender">
             <option value="male">Male</option>
             <option value="female">Female</option>
             <option value="other">Other</option>
           </select>
           <label for="email">Email</label>
           <input type="text" class="form-control" id="email" name="email" />
           <label for="contact_number">Contact number</label>
           <input type="text" class="form-control" id="contact_number" name="contact_number" />
           <label for="password">Password</label>
           <input type="password" class="form-control" id="password" name="password" />
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">
             Close
           </button>
           <button type="submit" class="btn btn-primary">Add</button>
         </div>
       </form>
     </div>
   </div>
 </div>
 <!-- update -->
 <div class="modal fade" id="edit{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header" id="mheader">
         <h5 class="modal-title">Update User / Incharge</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
         @csrf
         @method('put')
         <div class="modal-body">
           @if ($page ?? false)
             <input type="hidden" name="incharge" value="incharge">
           @endif
           <label for="image">Image</label>
           <input type="file" class="form-control" name="image" id="image" />
           <label for="first_name">First name</label>
           <input type="text" class="form-control" name="first_name" id="first_name"
             value="{{ $user->first_name }}" />
           <label for="last_name">Last name</label>
           <input type="text" class="form-control" name="last_name" id="last_name"
             value="{{ $user->last_name }}" />
           <label for="gender">Gender</label>
           <select id="gender" class="form-control" name="gender">
             <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Male</option>
             <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Female</option>
             <option value="other" {{ $user->gender === 'other' ? 'selected' : '' }}>Other</option>
           </select>
           <label for="email">Email</label>
           <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}" />
           <label for="contact_number">Contact number</label>
           <input type="text" class="form-control" name="contact_number" id="contact_number"
             value="{{ $user->contact_number }}" />
           <label for="password">New Password</label>
           <input type="password" class="form-control" name="password" id="password"
             placeholder="Enter new password if you wish to update it" />
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">
             Close
           </button>
           <button type="submit" class="btn btn-info">Update</button>
         </div>
       </form>
     </div>
   </div>
 </div>
 <!-- Delete -->
 <div class="modal fade" id="delete{{ $user->id }}" tabindex="-1" role="dialog"
   aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header" id="mheader">
         <h5 class="modal-title"></h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         Are you sure you want to delete this account?
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">
           No
         </button>
         <form action="{{ route('users.destroy', $user->id) }}" method="post">
           @csrf
           @method('delete')
           @if ($page ?? false)
             <input type="hidden" name="incharge" value="incharge">
           @endif
           <button type="submit" class="btn btn-danger">Yes</button>
         </form>
       </div>
     </div>
   </div>
 </div>
