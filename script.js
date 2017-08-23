/* mock data */
var batches = [
    {id:1,status:1,summary:"short description",courseid:1,coursename:"course 1",availseats:10,maxseats:20,startdate:'2017-06-20',enddate:'2017-08-20',teacher:'Subra'}
    ,{id:2,status:1,summary:"short description",courseid:1,coursename:"course 1",availseats:10,maxseats:20,startdate:'2017-06-20',enddate:'2017-08-20',teacher:'Subra'}
    ,{id:3,status:1,summary:"some other",courseid:2,coursename:"course 2",availseats:10,maxseats:20,startdate:'2017-06-20',enddate:'2017-08-20',teacher:'Surish'}
    ,{id:4,status:1,summary:"testing",courseid:3,coursename:"course 3",availseats:10,maxseats:20,startdate:'2017-06-20',enddate:'2017-08-20',teacher:'Tukaram'}
];
var batch_slots = [
    {timeslot:0,batchId:1}
    ,{timeslot:0,batchId:2}
    ,{timeslot:1,batchId:2}
    ,{timeslot:2,batchId:3}
    ,{timeslot:4,batchId:2}
    ,{timeslot:4,batchId:3}
    ,{timeslot:4,batchId:4}
    ,{timeslot:6,batchId:4}
    ,{timeslot:9,batchId:3}
    ,{timeslot:9,batchId:4}
    ,{timeslot:10,batchId:1}
];

/* GLOBAL VARIABLES */
var DAYS = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
var TIMES = ['9:30AM<br/>to<br/>11:45AM','12:00PM<br/>to<br/>2:15PM','2:30PM<br/>to<br/>4:45PM','5:00PM<br/>to<br/>8:00PM'];
var BATCH_GRID_TEMPLATE, BATCH_INFO_TEMPLATE;
var CACHE_NAME,CACHE_EMAIL;

/*** PAGE FUNCTIONS ***/
/**********************/

/* page load function */
$(function () {
    console.groupCollapsed("Initializing");
    $.get('/resources/php/connectToServer.php')
    .done(function ( data ) {
        batches = data[0];
        batch_slots = data[1];
    })
    .fail(function () {
        alert("FAILE TO RETRIEVE BATCH DATA");
    });

    console.groupCollapsed("Retrieving Templates");

    BATCH_GRID_TEMPLATE = $('#grid-container-template').html();
    BATCH_INFO_TEMPLATE = $('#batch-details-template').html();
    console.debug(BATCH_GRID_TEMPLATE);
    console.debug(BATCH_INFO_TEMPLATE);
    console.groupEnd();

    /* wire events */
    $('#btn-register').click(clickShowRegForm);
    $('#btn-complete').click(clickRegSubmit);

    /* build grid table */
    buildGrid();

    console.groupEnd();
});

/* builds main grid */
function buildGrid () {
    var grid = $("<table id='batch-grid' class='table'></table>");
    var row;
    var i = 0;
    /* build header row */
    for (var r = -1; r < TIMES.length; r++) {
        row = $('<tr></tr>');
        for (var c = -1; c < DAYS.length; c++) {
            if (r == -1 && c == -1) { // top left empty cell
                row.append("<th class='empty'></th>");
            } else if (r == -1) { // header row
                row.append("<th>" + DAYS[c] + "</th>");
            } else if (c == -1) { // time slot info column
                row.append("<th class='slot-info'>" + TIMES[r] + "</th>");
            } else { // valid grid cell
                row.append(buildGridCell(i));
                i++;
            }
        }
        grid.append(row);
    }
    /* add to page */
    $('#grid .table-responsive').append(grid);
}

/* builds grid cells */
function buildGridCell ( timeslot ) {
    /* get valid batch ids */
    var bs = batch_slots.map(function ( v ) {
        return (v.timeslot == timeslot) ? v.batchId : -1;
    });
    console.debug("adjusted batch timeslots array: " + bs);

    /* get batches for timeslot */
    var set = batches.filter(function ( v ) {
        return bs.indexOf(v.id) > -1;
    });
    console.debug("batches for this slot: %i", set.length);

    if (set.length > 0) {
        var cell = $('<td></td>');
        cell.addClass('gridset' + set.length);
        //
        for (var i = 0; i < set.length; i++) {
            cell.append(buildGridBatchItem(set[i]));
        }
        return cell;
    }
    return '<td></td>';
}

/* builds batch grid item that is placed with grid cell */
function buildGridBatchItem ( batch ) {
    console.debug("building grid item for batch: %O", batch);
    var tmp = BATCH_GRID_TEMPLATE.replace("__batchname__", batch.coursename);
    var cont = $(tmp);

    /* attach batch id */
    cont.attr('data-target', batch.id);
    /* attach style class */
    cont.addClass('grid-item-style-' + batches.indexOf(batch));

    /* attach click handler */
    cont.click(clickViewBatch);

    return cont;
}

/*** EVENT TRIGGERS ****/
/***********************/

/* open batch details popup when grid item is clicked */
function clickViewBatch ( e ) {
    console.groupCollapsed("Batch Details Click");
    /* retrieve batch id from html markup */
    var batchId = parseInt($(e.currentTarget).attr('data-target'));
    if (isNaN(batchId)) { 
        console.error("Invalid Batch Id: %s", batchId);
        return;
    }
    console.debug("batch Id: %i", batchId);

    /* retrieve batch object */
    var res = batches.filter(function ( b ) {
        return b.id == batchId;
    });
    console.debug("batches found: %i", res.length);
    /* sanity check. should never happen */
    if (res.length < 1) { console.error("No Batches Found On Lookup"); return; }
    if (res.length > 1) { console.error("More Than 1 Batch Found On Lookup"); return; }

    var batch = res[0];
    console.debug("batch object: %O", batch);

    /* build info from template */
    var tmp = BATCH_INFO_TEMPLATE;
    tmp = tmp.replace("__batchid__", batch.id);
    tmp = tmp.replace("__batchname__", batch.coursename);
    tmp = tmp.replace("__coursesummary__", batch.summary);
    tmp = tmp.replace("__availseats__", batch.availseats);
    tmp = tmp.replace("__maxseats__", batch.maxseats);

    /* update modal */
    $('#btn-register').attr('data-target', batch.id);
    $('#batchDetails .modal-body').html(tmp);
    $('#batchDetails').modal();

    console.groupEnd();
}

/* open registration form */
function clickShowRegForm ( e ) {
    console.groupCollapsed("Open Registration Form");
    /* hide details */
    $('#batchDetails').modal("hide");
    /* show form */
    $('#registerForm').modal();
    console.groupEnd();
}

/* send registration to server */
function clickRegSubmit ( e ) {
    console.groupCollapsed("Sending Registration");
    var name = $('#register-name').val();
    var email = $('#register-email').val();

    console.debug("register name: %s", name);
    console.debug("register email: %s", email);

    /* client side validation */
    var regAlphaNum = /^(?=[A-Za-z0-9 \.]+[A-Za-z])[A-Za-z0-9 \.]{4,20}$/; //regex to verify valid name
    var regEmail = /^[\w\.-]+@[\w\.-]+\.[a-z]{2,4}$/; // regex to verify valid email

    if (!regAlphaNum.test(name)) {
        alert("You Have Entered Invalid Characters In the 'Name' Field");
        return;
    }

    if (!regEmail.test(email)) {
        alert("You Have Entered An Invalid Email Address");
        return;
    }

     var batchId = parseInt($('#btn-register').attr('data-target'));

    /* all is well. send info to server */
    sendRegistration({
        username : name,
        useremail : email,
        batch : batchId
    });

    console.groupEnd();
}

/*** SERVER INTERACTION ***/
/**************************/
function sendRegistration ( regData ) {
    /* start progress bar */
    $('#resultDialog .modal-body')
    .html("<div class='progress'><div class='progress-bar'role='progressbar'aria-valuenow='100'aria-valuemin='0'aria-valuemax='100'style='width:100%'>processing...</div></div>");
    
    /* hide form */
    $('#registerForm').modal("hide");
    $('#resultDialog').modal();

    /* post registration */
    $.post('/resources/php/subs.php', regData)
    .done(function ( data) {
        if (data.err) {
             $('#resultDialog .modal-body').html("<h3>Registration Failed. <br/> Please Try Again</h3>");
        } else {
             $('#resultDialog .modal-body').html("<h3>Registration Successful</h3>");
        }
    })
    .fail(function () {
         $('#resultDialog .modal-body').html("<h3>Registration Failed. <br/> Please Try Again</h3>");
    });
}