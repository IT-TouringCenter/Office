<br>
{{--@include('easybook.templates.ticket.watermark')--}}
    <div style="background-color: lightblue; padding: 5px 5px 5px 15px;border: 0px solid #020202;border-radius: 3px; text-align: left; position: relative; float:center; font-size: 16px; width: 385px;">
        @include('easybook.templates.ticket.header')  

        <table border="0px" width="400px" style="padding-top: 20px;" cellpadding="5px">
            <tr>
                <td>{{-- ticket number --}} Ticket Number
                </td>
                <td> : </td>
                <td>{{ array_get($ticket,'ticketNumber') }}&nbsp;({{array_get($ticket,'transferMode') }})
                </td>
            <tr>
                <td>Transfer</td>
                <td> : </td>
                <td>CMECC
                </td>
            </tr>
            <tr>
                <td>
                    Hotel
                </td>
                <td> : </td>
                <td>{{ array_get($ticket,'hotelName') }}
                </td>
            </tr>
            <tr>
                <td>Date</td>
                <td> : </td>
                <td>{{array_get($ticket,'startDate')}}&nbsp; to &nbsp;{{array_get($ticket,'endDate') }}
            </tr>
                </td>
            </tr>
        </table>
            <div style="padding-top: 5px;">
                @include('easybook.templates.convention.footer')
            </div>
    </div>

<!--     @include('easybook.templates.convention.footer')
</div> -->