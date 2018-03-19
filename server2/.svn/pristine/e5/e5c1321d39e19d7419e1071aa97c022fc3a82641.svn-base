
{{--@include('easybook.templates.ticket.watermark')--}}
<div style="background-color: #a8ddf5;padding: 5px 10px 5px 10px;border: 1px dashed #020202;border-radius: 5px;max-width: 360px;margin-bottom: 10px;">
    @include('easybook.templates.ticket.header')  
    <div>
        {{-- ticket number --}}
        <div style="margin-top: 10px;">
            <div style="width: 105px;float: left;">Ticket Number</div>
            <div>:&nbsp;{{ array_get($ticket,'ticketNumber') }}&nbsp;({{ array_get($ticket,'transferMode') }})</div>
        </div>

        <div style="margin-top: 10px;">
            <div style="width: 105px;float: left;">Transfer</div>
            <div>:&nbsp;CMECC</div>
            <!-- <div>:&nbsp;{{ array_get($ticket,'hotelName') }}&nbsp; & &nbsp;Convention Centre</div> -->
        </div>
        
        <div style="margin-top: 10px;">
            <div style="width: 105px;float: left;">Hotel</div>
            <div>:&nbsp;{{ array_get($ticket,'hotelName') }}</div>
        </div>

        <div style="margin-top: 10px;">
            <div style="width: 105px;float: left;">Date</div>
            <div>:&nbsp;{{array_get($ticket,'startDate')}}&nbsp; to &nbsp;{{ array_get($ticket,'endDate') }}</div>
        </div>
    </div>
    @include('easybook.templates.convention.footer')
</div>