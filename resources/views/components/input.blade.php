@props(['value','oldvalue','type'])

<input style="padding:10px;" id="{{ $value }}" name="{{ $value }}" value="{{ $oldvalue }}" class="form-control" placeholder="Choose your {{ $value }}" aria-label="Username" type="{{ $type }}" aria-describedby="basic-addon1">
