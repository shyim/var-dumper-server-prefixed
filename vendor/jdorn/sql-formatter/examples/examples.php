<!DOCTYPE html>
<html>
<head>
    <title>SqlFormatter Examples</title>
    <style>
        body {
            font-family: arial;
        }

        table, td, th {
            border: 1px solid #aaa;
        }

        table {
            border-width: 1px 1px 0 0;
            border-spacing: 0;
        }

        td, th {
            border-width: 0 0 1px 1px;
            padding: 5px 10px;
            vertical-align: top;
        }

        pre {
            padding: 0;
            margin: 0;
        }
    </style>
</head>
<body>
<?php 
namespace _PhpScoper5d36eb080763e;

require_once __DIR__ . '/../lib/SqlFormatter.php';
// Example statements for formatting and highlighting
$statements = array("SELECT DATE_FORMAT(b.t_create, '%Y-%c-%d') dateID, b.title memo \n    FROM (SELECT id FROM orc_scheme_detail d WHERE d.business=208 \n    AND d.type IN (29,30,31,321,33,34,3542,361,327,38,39,40,41,42,431,4422,415,4546,47,48,'a',\n    29,30,31,321,33,34,3542,361,327,38,39,40,41,42,431,4422,415,4546,47,48,'a') \n    AND d.title IS NOT NULL AND t_create >= \n    DATE_FORMAT((DATE_SUB(NOW(),INTERVAL 1 DAY)),'%Y-%c-%d') AND t_create \n    < DATE_FORMAT(NOW(), '%Y-%c-%d') ORDER BY d.id LIMIT 2,10) a, \n    orc_scheme_detail b WHERE a.id = b.id", "SELECT * from Table1 LEFT \n    OUTER JOIN Table2 on Table1.id = Table2.id", "SELECT * FROM MyTable WHERE id = 46", "SELECT count(*),`Column1` as count,`Testing`, `Testing Three` FROM `Table1`\n    WHERE Column1 = 'testing' AND ( (`Column2` = `Column3` OR Column4 >= NOW()) )\n    GROUP BY Column1 ORDER BY Column3 DESC LIMIT 5,10", "select * from `Table`, (SELECT group_concat(column1) as col FROM Table2 GROUP BY category)\n    Table2, Table3 where Table2.col = (Table3.col2 - `Table`.id)", "insert ignore into Table3 (column1, column2) VALUES ('test1','test2'), ('test3','test4');", "UPDATE MyTable SET name='sql', category='databases' WHERE id > '65'", "delete from MyTable WHERE name LIKE \"test%\"", "SELECT * FROM UnmatchedParens WHERE ( A = B)) AND (((Test=1)", "-- This is a comment\n    SELECT\n    /* This is another comment\n    On more than one line */\n    Id #This is one final comment\n    as temp, DateCreated as Created FROM MyTable;");
// Example statements for splitting SQL strings into individual queries
$split_statements = array("DROP TABLE IF EXISTS MyTable;\n    CREATE TABLE MyTable ( id int );\n    INSERT INTO MyTable    (id)\n        VALUES\n        (1),(2),(3),(4);\n    SELECT * FROM MyTable;", "SELECT \";\"; SELECT \";\\\"; a;\";\n    SELECT \";\n        abc\";\n    SELECT a,b #comment;\n    FROM test;", "\n    -- Drop the table first if it exists\n    DROP TABLE IF EXISTS MyTable;\n\n    -- Create the table\n    CREATE TABLE MyTable ( id int );\n\n    -- Insert values\n    INSERT INTO MyTable (id)\n        VALUES\n        (1),(2),(3),(4);\n\n    -- Done");
// Example statements for removing comments
$comment_statements = array("-- This is a comment\n    SELECT\n    /* This is another comment\n    On more than one line */\n    Id #This is one final comment\n    as temp, DateCreated as Created FROM MyTable;");
?>


<h1>Formatting And Syntax Highlighting</h1>

<div>
    Usage:
    <pre>
    <?php 
\highlight_string('<?php' . "\n" . '$formatted = SqlFormatter::format($sql);' . "\n" . '?>');
?>
    </pre>
</div>
<table>
    <tr>
        <th>Original</th>
        <th>Formatted And Highlighted</th>
    </tr>
    <?php 
foreach ($statements as $sql) {
    ?>
    <tr>
        <td>
            <pre><?php 
    echo $sql;
    ?></pre>
        </td>
        <td><?php 
    echo \_PhpScoper5d36eb080763e\SqlFormatter::format($sql);
    ?></td>
    </tr>
    <?php 
}
?>
</table>


<h1>Formatting Only</h1>

<div>
    Usage:
    <pre>
    <?php 
\highlight_string('<?php' . "\n" . '$formatted = SqlFormatter::format($sql, false);' . "\n" . '?>');
?>
    </pre>
</div>
<table>
    <tr>
        <th>Original</th>
        <th>Formatted</th>
    </tr>
    <?php 
foreach ($statements as $sql) {
    ?>
    <tr>
        <td>
            <pre><?php 
    echo $sql;
    ?></pre>
        </td>
        <td><pre><?php 
    echo \htmlentities(\_PhpScoper5d36eb080763e\SqlFormatter::format($sql, \false));
    ?></pre></td>
    </tr>
    <?php 
}
?>
</table>


<h1>Syntax Highlighting Only</h1>

<div>
    Usage:
    <pre>
    <?php 
\highlight_string('<?php' . "\n" . '$highlighted = SqlFormatter::highlight($sql);' . "\n" . '?>');
?>
    </pre>
</div>
<table>
    <tr>
        <th>Original</th>
        <th>Highlighted</th>
    </tr>
    <?php 
foreach ($statements as $sql) {
    ?>
    <tr>
        <td>
            <pre><?php 
    echo $sql;
    ?></pre>
        </td>
        <td><?php 
    echo \_PhpScoper5d36eb080763e\SqlFormatter::highlight($sql);
    ?></td>
    </tr>
    <?php 
}
?>
</table>


<h1>Compress Query</h1>

<div>
    Usage:
    <pre>
    <?php 
\highlight_string('<?php' . "\n" . '$compressed = SqlFormatter::compress($sql);' . "\n" . '?>');
?>
    </pre>
</div>
<table>
    <tr>
        <th>Original</th>
        <th>Compressed</th>
    </tr>
    <?php 
foreach ($statements as $sql) {
    ?>
    <tr>
        <td>
            <pre><?php 
    echo $sql;
    ?></pre>
        </td>
        <td><pre><?php 
    echo \_PhpScoper5d36eb080763e\SqlFormatter::compress($sql);
    ?></pre></td>
    </tr>
    <?php 
}
?>
</table>


<h1>Splitting SQL Strings Into Individual Queries</h1>

<div>
    Usage:
    <pre>
    <?php 
\highlight_string('<?php' . "\n" . '$queries = SqlFormatter::splitQuery($sql);' . "\n" . '?>');
?>
    </pre>
</div>
<table>
    <tr>
        <th>Original</th>
        <th>Split</th>
    </tr>
    <?php 
foreach ($split_statements as $sql) {
    ?>
    <tr>
        <td>
            <pre><?php 
    echo \_PhpScoper5d36eb080763e\SqlFormatter::highlight($sql);
    ?></pre>
        </td>
        <td><?php 
    $queries = \_PhpScoper5d36eb080763e\SqlFormatter::splitQuery($sql);
    echo "<ol>";
    foreach ($queries as $query) {
        echo "<li><pre>" . \_PhpScoper5d36eb080763e\SqlFormatter::highlight($query) . "</pre></li>";
    }
    echo "</ol>";
    ?></td>
    </tr>
    <?php 
}
?>
</table>


<h1>Removing Comments</h1>

<div>
    Usage:
    <pre>
    <?php 
\highlight_string('<?php' . "\n" . '$nocomments = SqlFormatter::removeComments($sql);' . "\n" . '?>');
?>
    </pre>
</div>
<table>
    <tr>
        <th>Original</th>
        <th>Comments Removed</th>
    </tr>
    <?php 
foreach ($comment_statements as $sql) {
    ?>
    <tr>
        <td>
            <pre><?php 
    echo \_PhpScoper5d36eb080763e\SqlFormatter::highlight($sql);
    ?></pre>
        </td>
        <td>
            <pre><?php 
    echo \_PhpScoper5d36eb080763e\SqlFormatter::highlight(\_PhpScoper5d36eb080763e\SqlFormatter::removeComments($sql));
    ?></pre>
        </td>
    </tr>
    <?php 
}
?>
</table>

</body>
</html>
<?php 
