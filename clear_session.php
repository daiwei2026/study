<?php
session_start();
session_destroy(); // 销毁session
echo "Session cleared"; // 可选，返回一些信息表示操作成功
