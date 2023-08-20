@props(['value'])
@error($value)
    <p style="color:red;" class="my-2" >{{ $message }}</p>
@enderror
