<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Template</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
</head>


<body style="margin: 0;">
    <style>
        @media screen and (max-width: 600px) {
            .title {
                font-size: 26px;
            }

            p {
                font-size: 14px;
            }

            .footerPLantsasri {
                font-size: 12px;
            }
        }

    </style>

    <div class="container" style="height: 100%; width: 100%;">
        <div class="wrapperContainer" style="margin: auto; width: 100%; max-width: 800px;">
            <div class="wrapperHead" style="background-color: #32D18B; padding: 3rem; border-radius: 10px 10px 0 0; ">
                <table style="width: 100%;">
                    <tbody>
                        <tr>
                            <td align="center">
                                <div class="icon" style="background-color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; padding: 1rem; width: max-content;">
                                    <img style="width: 100%; max-width: 52px;" src="https://i.ibb.co/0jcG7Sv/document-2-1.png" alt="">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <center>
                    <h1 class="title"
                        style="color: #fff; font-family: 'Poppins', sans-serif; margin: 0; margin-bottom: .7rem;">Your
                        Request</h1>
                </center>
                <center>
                    <p class="date" style="color: #fff; font-family: 'Poppins', sans-serif;">
                        {{ Carbon\Carbon::now()->toDateString() }}</p>
                </center>
            </div>


            @php
                $status = [];
                $status[0] = 'Waiting approval';
                $status[1] = 'Order Processed';
                $status[2] = 'Quarantine Process';
                $status[3] = 'Order Shipped';
                $status[4] = 'Shipped';
                $status[5] = 'Reviews';

            @endphp

            <div class="wrapperBody" style="background: #fff; padding: 2rem 3rem; border-radius: 0 0 10px 10px;">
                <div class="text" style="text-align: center; font-family: 'Poppins', sans-serif;">
                    <p style="margin: 0; margin-bottom:.5rem;">Hi <span class="name"
                            style="font-weight: 600;">{{ $data->nama_penerima }},</span></p>
                    <p style="margin: 0;">Your Request, <span class="numberRequest"
                            style="color: #32D18B; font-weight: 600;">{{ $data->kode_transaksi }},</span></p>
                    <p style="margin: 0;">We are currently in {{ $status[$data->status] }}, please wait a moment.</p>
                </div>

                <table style="width: 100%; padding: 1rem 0;">
                    <tbody>
                        <tr>
                            <td align="center">
                                <a href="https://plantsasri.co.id/" style="font-family: 'Poppins', sans-serif; background: #32D18B; padding: .8rem 2rem; border-radius: 6px; text-decoration: none; color: #fff;">View More</a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <p class="footerPLantsasri" style="text-align: center; font-family: 'Poppins', sans-serif;">Thanks for
                    choosing Plantsasri.com
                </p>
            </div>

        </div>
    </div>

</body>

</html>
