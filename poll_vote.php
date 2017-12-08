<?php 
  // 接收参数q
  $vote = htmlspecialchars($_REQUEST['q']);
  // 获取文件中存储的数据(这里需要在同一目录下新建一个poll_result.txt文件)
  $filename = "poll_result.txt";
  $conn = file($filename);
  // 将数据分割到数组
  $array = explode("||", $conn[0]);
  $yes = $array[0];
  $no = $array[1];
  $count = $array[2];
  if ($vote == 0) {
    $yes += 1;
    $count += 1;
  }
  if ($vote == 1) {
    $no += 1;
    $count += 1;
  }
  // 将投票数据保存到文档
  $insertvote = $yes . '||' . $no . '||' . $count;
  $fp = fopen($filename, "w");
  fputs($fp, $insertvote);
  fclose($fp);
 ?>
 <h2>结果：</h2>
 <table>
  <tr>
    <td>是:</td>
    <td>
      <span style="display: inline-block; 
background-color: green; width:
 <?php echo 100 * round($yes / ($yes + $no), 2);?>
 px; height: 20px;"></span>
 <?php echo 100 * round($yes / ($yes + $no), 2); ?>%
    </td>
  </tr>
  <tr>
    <td>否:</td>
    <td>
      <span style="display: inline-block;
  background-color: red; width: 
  <?php echo 100 * round($no / ($yes + $no), 2);?>
  px; height: 20px;"></span>
  <?php echo 100 * round($no / ($yes + $no), 2); ?>%
    </td>
  </tr>
 </table>
 <p><?php echo "参与人数：" . $count; ?></p>