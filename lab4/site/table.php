<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $cols = abs((int) $_POST['cols']);
  $rows = abs((int) $_POST['rows']);
  $color = trim(strip_tags($_POST['color']));
}
$cols = ($cols) ? $cols : 10;
$rows = ($rows) ? $rows : 10;
$color = ($color) ? $color : '#ffff00';
?>
<!-- Область основного контента -->
<h3>Таблица умножения</h3>
<form action='<?= $_SERVER['REQUEST_URI'] ?>' method='POST'>
  <label>Количество колонок: </label>
  <br>
  <input name='cols' type='text' value='<?= isset($_POST['cols']) ? $_POST['cols'] : '' ?>'>
  <br>
  <label>Количество строк: </label>
  <br>
  <input name='rows' type='text' value='<?= isset($_POST['rows']) ? $_POST['rows'] : '' ?>'>
  <br>
  <label>Цвет: </label>
  <br>
  <input name='color' type='color' value='<?= isset($_POST['color']) ? $_POST['color'] : '#ff0000' ?>' list="listColors">
  <datalist id="listColors">
    <option>#ff0000</option>
    <option>#00ff00</option>
    <option>#0000ff</option>
  </datalist>
  <br>
  <br>
  <input type='submit' value='Создать'>
</form>
<br>
<!-- Таблица -->
<?php
getTable($rows, $cols, $color);
?>
<!-- Таблица -->
<!-- Область основного контента -->