<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    body{
        background: #f4f6f8;
        font-family: "Segoe UI", Arial, Helvetica, sans-serif;
        font-size: 14px;
        color: #333;
    }

    .bulletin{
        width: 210mm;
        margin: 20px auto;
        background: #fff;
        padding: 25px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .header{
        display: flex;
        justify-content: space-between;
        border-bottom: 2px solid #2c3e50;
        padding: 15px;
    }
    .header h1 {
        margin: 0;
        font-size: 20px;
        color: #2c3e50;
    }
    .header h2 {
        margin: 0;
        font-size: 20px;
    }
    .infos{
        display: flex;
        justify-content: space-between;
        margin: 20px 0;
        background: #f9fafb;
        padding: 15px;
        border-left: 4px solid #2c3e50;
    }
    .table-paie{
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    .table-paie th{
        background: #2c3e50;
        color: #fff;
        padding: 10px;
        text-align: left;

    }
    .table-paie td{
        border-bottom: 1px solid #ddd;
        padding: 8px;
    }
    .table-paie tr:nth-child(even){
        background: #f5f7f9;
    }
    .negatif{
        color: #c0392b;
    }
    .total{
        display: flex;
        justify-content: space-between;
        margin-top: 25px;
        padding: 15px;
        background: #ecf0f1;
        font-size: 18px;
        font-weight: bold;
    }
    .net{
        color: #27ae60;
    }
    .footer{
        text-align: center;
        margin-top: 30px;
        margin-bottom: 30px;
        font-size: 12px;
        color: #777;
    }
    .signatures{
        text-align: center;
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        color: #777;
    }
    .left{
        width: auto;
    }
    @media print{
        body{
            background: none;
        }
        .bulletin{
            box-shadow: none;
            margin: 0;
        }
    }
    @page{
        size:A4;
        margin:15mm;
    }

</style>
<body>
    <div class="row">
        {{$slot}} 
    </div>
</body>
</html>