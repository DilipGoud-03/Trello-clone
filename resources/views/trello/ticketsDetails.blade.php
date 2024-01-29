<form action="">
    @csrf
    <input type="text" name="ticketName" id="" value="{{$tickets->name}}">
    <textarea name="description" id="description" cols="30" rows="10" value="{{$tickets->description}}"></textarea>
</form>