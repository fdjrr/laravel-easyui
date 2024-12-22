<div class="h-full p-2">
    <table class="easyui-datagrid" id="dg"></table>
    <div id="toolbar">
        <div class="flex flex-col items-center p-2 sm:flex-row sm:justify-between">
            <div>
                <a class="easyui-linkbutton" href="javascript:void(0)" iconCls="icon-add" plain="true"
                    onclick="newUser()">New User</a>
                <a class="easyui-linkbutton" href="javascript:void(0)" iconCls="icon-edit" plain="true"
                    onclick="editUser()">Edit User</a>
                <a class="easyui-linkbutton" href="javascript:void(0)" iconCls="icon-remove" plain="true"
                    onclick="destroyUser()">Remove User</a>
            </div>
            <div>
                <input class="easyui-searchbox w-[300px]" id="search"
                    data-options="prompt:'Search',searcher:doSearch">
            </div>
        </div>
    </div>
    <div class="easyui-dialog w-[400px]" id="dlg"
        data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
        <form class="px-3" id="fm" method="post" novalidate>
            <div class="mb-3">
                <input class="easyui-textbox" name="name" style="width: 100%" required="true" labelPosition="top"
                    label="Name:">
            </div>
            <div class="mb-3">
                <input class="easyui-textbox" name="email" style="width: 100%" required="true" labelPosition="top"
                    validType="email" label="Email:">
            </div>
            <div class="mb-3">
                <input class="easyui-textbox" name="password" type="password" style="width: 100%" labelPosition="top"
                    validType="length[8, 32]" label="Password:">
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a class="easyui-linkbutton c6 w-[90px]" href="javascript:void(0)" iconCls="icon-ok"
            onclick="saveUser()">Save</a>
        <a class="easyui-linkbutton w-[90px]" href="javascript:void(0)" iconCls="icon-cancel"
            onclick="javascript:$('#dlg').dialog('close')">Cancel</a>
    </div>
</div>

<script>
    $(function() {
        $('#dg').datagrid({
            url: '/api/v1/users',
            method: 'get',
            toolbar: '#toolbar',
            pagination: true,
            fit: true,
            rownumbers: true,
            fitColumns: true,
            singleSelect: true,
            remoteSort: false,
            multiSort: true,
            columns: [
                [{
                        field: 'name',
                        title: 'Name',
                        width: 50,
                        sortable: true
                    },
                    {
                        field: 'email',
                        title: 'Email',
                        width: 50,
                        sortable: true
                    }
                ]
            ],
        });
    });

    var url;
    var method;

    function doSearch() {
        $('#dg').datagrid('load', {
            search: $('#search').val()
        });
    }

    function newUser() {
        $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'New User');
        $('#fm').form('clear');
        url = '/api/v1/users';
        method = 'create';
    }

    function editUser() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Edit User');
            $('#fm').form('load', row);
            url = `/api/v1/users/${row.id}`
            method = 'update';
        } else {
            $.messager.show({
                title: 'Error',
                timeout: 3000,
                msg: 'Please select a user'
            });
        }
    }

    async function saveUser() {
        const fm = $('#fm')[0];

        const formData = new FormData(fm);

        try {
            var req

            if (method === 'create') {
                req = await axios.post(url, formData, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });
            } else {
                req = await axios.put(url, formData, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });
            }

            const result = req.data;

            if (result.success) {
                $('#dlg').dialog('close');
                $('#dg').datagrid('reload');

                $.messager.show({
                    title: 'Success',
                    timeout: 3000,
                    msg: result.message
                })
            } else {
                $.messager.show({
                    title: 'Error',
                    timeout: 3000,
                    msg: result.message
                });
            }
        } catch (error) {
            const result = error.response.data;

            $.messager.show({
                title: 'Error',
                timeout: 3000,
                msg: result.message
            })
        }
    }

    function destroyUser() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $.messager.confirm('Confirm', 'Are you sure you want to destroy this user?', async function(r) {
                if (r) {
                    try {
                        const req = await axios.delete(`/api/v1/users/${row.id}`, {
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            }
                        });

                        const result = req.data;

                        if (result.success) {
                            $('#dg').datagrid('reload');

                            $.messager.show({
                                title: 'Success',
                                timeout: 3000,
                                msg: result.message
                            });
                        } else {
                            $.messager.show({
                                title: 'Error',
                                timeout: 3000,
                                msg: result.message
                            });
                        }
                    } catch (error) {
                        const result = error.response.data;

                        $.messager.show({
                            title: 'Error',
                            timeout: 3000,
                            msg: result.message
                        })
                    }
                }
            });
        } else {
            $.messager.show({
                title: 'Error',
                timeout: 3000,
                msg: 'Please select a user'
            });
        }
    }
</script>
