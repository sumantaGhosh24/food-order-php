<?php require "./includes/header.php"; ?>

<div class="min-h-screen pt-8 bg-white container mx-auto">
    <div class="overflow-x-scroll">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-center">Manage Contact Us</h2>
            <span id="form_error" class="text-red-500 font-bold text-center my-3"></span>
            <span id="form_success" class="text-green-500 font-bold text-center my-3"></span>
        </div>
        <table class="min-w-full bg-white rounded-lg shadow-md mx-auto mt-5">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-left">Mobile</th>
                    <th class="py-3 px-6 text-left">Message</th>
                    <th class="py-3 px-6 text-left">Created At</th>
                    <th class="py-3 px-6 text-left">Updated At</th>
                    <th class="py-3 px-6 text-left">Actions</th>
                </tr>
            </thead>
            <tbody id="contacts"></tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        function fetchContacts() {
            $.ajax({
                url: "http://localhost:3000/admin/includes/contact_us.php?admin=true",
                type: "get",
                success: function (result) {
                    let contacts = $.parseJSON(result);

                    $("#contacts").html("");

                    contacts.forEach(contact => {
                        $("#contacts").append(`
                            <tr>
                                <td class="py-3 px-6 text-left">${contact.id}</td>
                                <td class="py-3 px-6 text-left">${contact.name}</td>
                                <td class="py-3 px-6 text-left">${contact.email}</td>
                                <td class="py-3 px-6 text-left">${contact.mobile}</td>
                                <td class="py-3 px-6 text-left">${contact.message}</td>
                                <td class="py-3 px-6 text-left">${contact.createdAt}</td>
                                <td class="py-3 px-6 text-left">${contact.updatedAt}</td>
                                <td class="py-3 px-6 text-left flex items-center gap-3">
                                    <form class="contact_delete_form">
                                        <button type="submit" class="w-fit bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors disabled:bg-red-200">Delete</button>
                                        <input type="hidden" name="id" value="${contact.id}" />
                                        <input type="hidden" name="action" value="delete" />
                                    </form>
                                </td>
                            </tr>
                        `);
                    })
                }
            })
        }

        fetchContacts()

        $(document).on("submit", ".contact_delete_form", function (e) {
            e.preventDefault();

            let form = $(this);
            let button = form.find("button[type='submit']");

            $("#form_error").html("");
            $("#form_success").html("");
            button.attr("disabled", true).text("Processing...");

            $.ajax({
                url: "http://localhost:3000/admin/includes/contact_us.php",
                type: "post",
                data: form.serialize(),
                success: function (result) {
                    button.attr("disabled", false).text("Delete");

                    var data = $.parseJSON(result);

                    if (data.status === "error") {
                        $("#form_error").html(data.msg);
                    }

                    if (data.status === "success") {
                        $("#form_success").html(data.msg);
                        fetchContacts();
                    }
                }
            });
        });
    })
</script>

<?php require "./includes/footer.php"; ?>