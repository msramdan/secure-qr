<?php
function format($params)
{
  return "Rp " . number_format($params, 2, ',', '.');
}
