<table class="table">
<? $previous_event_id = -1 ?>
<? foreach($data['tickets'] as $key=>$ticket) { ?>
    <? if ($ticket['event_id'] != $previous_event_id) { ?>
    <? $previous_event_id = $ticket['event_id']; ?>
    <tr>
        <!--<td>
            <input type="checkbox" id="tickets-<?=$ticket['event_id']?>">
        </td>-->
        <th colspan="5">
            <h4>
                <?=$ticket['event_name']?> <?=$ticket['event_date']?>
            </h4>
        </th>
    </tr>
    <tr>
        <th></th>
        <th>Сектор</th>
        <th>Ряд</th>
        <th>Место</th>
        <th>Цена</th>
    </tr>
    <? } ?>
    <tr id="ticket-<?=$ticket['event_id']?>-<?=$ticket['place_id']?>">
        <td>
            <input <?=$ticket['sale_available']?"":"disabled"?> type="checkbox" class="checkbox-ticket" data-event-id="<?=$ticket['event_id']?>"
                   data-place-id="<?=$ticket['place_id']?>" data-price="<?=$ticket['price']?>">
        </td>
        <td>
            <?=$ticket['sector_name']?>
        </td>
        <td>
            <?=$ticket['row_no']?>
        </td>
        <td>
            <?=$ticket['place_no']?>
        </td>
        <td>
            <?=$ticket['price']?> грн
        </td>
    </tr>
<? } ?>
</table>
<div class="text-right">
    <h4>Итого: <b id="total">0</b> грн.</h4>
</div>
<script>
    /*
        tickets = {
            eventId,
            placeId,
            price
        }
         */
    var tickets = [];

    $('#btn-modal-delete-reserve').addClass('disabled');
    $('#btn-modal-sell-reserve').addClass('disabled');
    $("#dialog-modal").children().first().modal();

    $(".checkbox-ticket").on("change",  function (event) {
        var sender = event.target;
        var ticket = event.target.dataset;
        if (sender.checked) {
            $("#ticket-"+ticket.eventId+"-"+ticket.placeId).addClass("success");
            tickets.push(ticket);
            $("#total").html(parseFloat($("#total").html())+parseFloat(ticket.price));
            $('#btn-modal-delete-reserve').removeClass('disabled');
            $('#btn-modal-sell-reserve').removeClass('disabled');
        } else {
            $("#ticket-"+ticket.eventId+"-"+ticket.placeId).removeClass("success");
            tickets.splice(tickets.indexOf(ticket), 1);
            $("#total").html(parseFloat($("#total").html())-parseFloat(ticket.price));
            if (tickets.length == 0) {
                $('#btn-modal-delete-reserve').addClass('disabled');
                $('#btn-modal-sell-reserve').addClass('disabled');
            }
        }
    });
    $('#btn-modal-delete-reserve').click(function () {
        $(this).addClass('disabled');
    });
    $('#btn-modal-sell-reserve').click(function () {
        $(this).addClass('disabled');
        $.post("/tickets/reserveSell", {
            tickets: JSON.stringify(tickets)
        }).done(function (response) {
            $("#dialog-modal").children().first().modal("hide").on('hidden.bs.modal', function () {
                $('#dialog-modal').unbind().html(response);
            });
        });
    });
</script>