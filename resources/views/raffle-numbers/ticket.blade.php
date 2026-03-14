<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raffle Ticket</title>
    <style>
        @page { margin: 0; }
        body { margin: 0; padding: 0; }
        h1, p { margin: 0; }
        
    </style>
</head>
<body>
    <style>
  @page { margin: 0; }
  body { margin: 0; padding: 0; font-family: Arial, sans-serif; font-size: 11px; color: #111; }

  .ticket {
    width: 227.67px;
    padding: 10px 12px;
    box-sizing: border-box;
  }

  .title {
    text-align: center;
    font-weight: 700;
    font-size: 13px;
    margin: 2px 0 6px 0;
    letter-spacing: .5px;
    text-transform: uppercase;
  }

  .raffle-name {
    font-size: 12px;
    font-weight: 700;
    margin: 0 0 6px 0;
  }

  .meta {
    display: block;
    margin: 0;
    padding: 0;
  }

  .row {
    margin: 0;
    padding: 2px 0;
    line-height: 1.25;
  }

  .label {
    font-weight: 700;
  }

.divider{
  border: 0;
  border-top: 2px dashed #333;
  margin: 10px 0;
  width: 100%;
}

  .code-box {
    text-align: center;
    font-size: 18px;
    font-weight: 800;
    letter-spacing: 2px;
    margin: 6px 0 2px 0;
  }

  .small {
    font-size: 10px;
    color: #333;
  }

  .footer {
    text-align: center;
    margin-top: 8px;
    font-size: 10px;
    color: #333;
  }
</style>

<div style="padding: 10px;" id="ticket">
  <div class="title">BOLETO DE RIFA</div>

  <p class="raffle-name" style="margin-top:10px">
    Rifa: {{ $raffleNumber['name'] ?? '' }}
  </p>

  <div class="divider"></div>

  <div class="code-box">
    {{ $raffleNumber['code'] ?? '' }}
  </div>
  <div class="footer small">NÚMERO DE BOLETO</div>
  <div class="divider"></div>

  
  <p class="row" >
    <span class="label">Asignado:</span>
    {{ $raffleNumber['assigned_at'] ?? '0000-00-00 00:00:00' }}
  </p>

  <p class="row">
    <span class="label">Tel:</span>
    {{ $raffleNumber['customer_phone'] ?? '-' }}
  </p>

  <p class="row">
    <span class="label">Venta:</span>
    {{ $raffleNumber['saleable_type'] ?? '-' }}
  </p>

  <p class="row">
    <span class="label">Nota:</span>
    {{ $raffleNumber['saleable_id'] ?? '-' }}
  </p>

  
  <div class="divider"></div>
  <div class="footer">
    Conserva este ticket como comprobante.
  </div>
</div>
</body>
</html>