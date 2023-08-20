@props(['value', 'placeholder'])

<textarea id="{{ $value }}" name="{{ $value }}" placeholder="{{ $placeholder ? $placeholder : old($value) }}" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>