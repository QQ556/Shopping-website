@extends('layouts.app')
<form action={{url('add')}} method="POST">
    @csrf
    商品<input type="text" name="id" value="2"><br>
    名字<input type="text" name="name" value="2"><br>
    價錢<input type="text" name="price" value="2"><br>
    數量<input type="text" name="quantity" value="2"><br>
    <input type="submit" value="submit">
</form>
<button id='destroy'>刪除所有</button>
<script>
    $('#destroy').click(function () {
        alert('click');
    })
</script>