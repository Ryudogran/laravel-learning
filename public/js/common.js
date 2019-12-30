'use strict'
function showPopupDelete(message,id)
{
    const popup = $('.modal');
    const PopupAction = 'DELETE';
    if(popup)
    {
        $('.popup').html(message);
        popup.fadeIn();
        $('input[name="popup"]').val(id);
        $('input[name="popupAction"]').val(PopupAction);
    }
}

function showPopup()
{
    const popup = $('.modalNotification');
    const popupMessage = $('.popupMessage').val();
    // console.log(popup)
    if(popup)
    {
        $('.popup').html(popupMessage)
        popup.fadeIn();
    }
}

function getExtUrl()
{
    const currentUrl = window.location.href;
}

function deleteCompanyAjax(id)
{
    const deleteURL = '/companies/' + id;
    $.ajax({
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: deleteURL,
        type: 'DELETE',
        processData: false,
        contentType: false,
        // context: this,
        success: function (result) {
            const rowDeleteId = 'row'+id;
            let rowElement = document.getElementById(rowDeleteId);
            console.log(rowElement);
            if(rowElement)
            {
                rowElement.remove();
            }
            else
            {
                const nameInputFind= 'input[name="id"]';
                rowElement = document.querySelectorAll(nameInputFind);
                for(let i = 0; i < rowElement.length; i++)
                {
                    if(rowElement[i].value===id)
                    {
                        rowElement[i].parentNode.parentNode.remove();
                    }
                }
            }

        },
        error: function (result) {
            // console.log(result);
            alert('FAIL TO DELETE BECAUSE UNKNOWN REASON');
        }
    });
}

$(document).ready(function () {
    showPopup()

    // list company page
    $('.btnCreateCompany').click(function () {
        const urlCreateCompany = $(this).data('route');
        location.href = urlCreateCompany;
    })

    $('#user-table').on('click', '.btnEditCompany', function (e) {
        e.preventDefault();
        const urlEditCompany = $(this).data('route');
        location.href = urlEditCompany;
    })

    $('#user-table').on('click', '.btnDeleteCompany', function (e) {
        e.preventDefault();
        const message = $(this).data('message');
        const companyId = $(this).parent().parent().find('input[name="id"]').val();
        showPopupDelete(message,companyId);
    })
    // btnDeleteDatatableCompany
    $('#user-table').on('click', '.btnDeleteDatatableCompany', function (e) {
        e.preventDefault();
        const message = $(this).data('message');
        const companyId = $(this).parent().find('input[name="id"]').val();
        showPopupDelete(message,companyId);
    })

    $('#user-table').on('click', '.btnViewEmployees', function (e) {
        e.preventDefault();
        const urlViewEmployeesInCompany = $(this).data('route');
        location.href = urlViewEmployeesInCompany;
    })

    // create company page
    $(".modal-close").click(function(){
        $('#modal03').fadeOut();
    });

    $(".btn-listCompany").click(function(){
        const urlToListCompany = $(this).data('route');
        location.href = urlToListCompany;
    });

    $('.btnCreateEmployee').click(function () {
        const urlCreateCompany = $(this).data('route');
        location.href = urlCreateCompany;
    })

    $('.btnEditEmployee').click(function () {
        const urlEditCompany = $(this).data('route');
        location.href = urlEditCompany;
    })

    $('.btnDeleteEmployee').click(function () {
        const urlDeleteCompany = $(this).data('route');
        location.href = urlDeleteCompany;
    })

    $('.btnPopupOk').on('click', function (e) {
        e.preventDefault();
        const action = $('input[name="popupAction"]').val();
        // const id = $('input[name="popup"]').val();
        const id = $('input[name="popup"]').val();
        if(action !== "" && action === 'DELETE')
        {
            deleteCompanyAjax(id);
        }
    })
})
