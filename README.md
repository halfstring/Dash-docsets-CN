# Dash Docset CN


PHP的中文版Dash手册。

Usage:

``` 
1. 从https://www.php.net/download-docs.php 下载最新的 <Many HTML files> 解压覆盖PHP.CN.docset/Contents/Resources/Documents/中的文档

> cd /path/to/Dash-docsets-CN/src
> php ./index.php 
> cd /path/to/Dash-docsets-CN/PHP.CN.docset/Contents/Resources
> sqlite3 docSet.dsidx 
    sqlite> DELETE FROM searchIndex;
> cat docSet.sql | sqlite3 docSet.dsidx 

# 大功告成。
```


## 导入
- 双击PHP.CN.docset 文件导入dash
- 或者打开dash 从本地添加PHP.CN.docset
