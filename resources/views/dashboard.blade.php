<x-app-layout>
    <table class="easyui-datagrid" id="dg" title="My Users" url="/api/v1/users" method="get" toolbar="#toolbar" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="name" width="50">Name</th>
                <th field="email" width="50">Email</th>
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <table style="width:100%" cellpadding="0" cellspacing="0">
            <tr>
                <td style="padding-left:2px">
                    <a class="easyui-linkbutton" href="javascript:void(0)" iconCls="icon-add" plain="true" onclick="newUser()">New User</a>
                    <a class="easyui-linkbutton" href="javascript:void(0)" iconCls="icon-edit" plain="true" onclick="editUser()">Edit User</a>
                    <a class="easyui-linkbutton" href="javascript:void(0)" iconCls="icon-remove" plain="true" onclick="destroyUser()">Remove User</a>
                </td>
                <td style="text-align:right;padding-right:2px">
                    <input class="easyui-searchbox" id="search" data-options="prompt:'Search',searcher:doSearch" style="width:300px">
                </td>
            </tr>
        </table>
    </div>

    <div class="easyui-dialog" id="dlg" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'" style="width:400px">
        <form id="fm" style="margin:0;padding:0px 10px" method="post" novalidate>
            <div style="margin-bottom:10px">
                <input class="easyui-textbox" name="name" style="width:100%" required="true" labelPosition="top" label="Name:">
            </div>
            <div style="margin-bottom:10px">
                <input class="easyui-textbox" name="email" style="width:100%" required="true" labelPosition="top" validType="email" label="Email:">
            </div>
            <div style="margin-bottom:10px">
                <input class="easyui-textbox" name="password" type="password" style="width:100%" labelPosition="top" validType="length[8, 32]" label="Password:">
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a class="easyui-linkbutton c6" href="javascript:void(0)" style="width:90px" iconCls="icon-ok" onclick="saveUser()">Save</a>
        <a class="easyui-linkbutton" href="javascript:void(0)" style="width:90px" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>
    </div>
    <script type="text/javascript">
        function doSearch() {
            $('#dg').datagrid('load', {
                search: $('#search').val()
            });
        }

        var url;
        var method;

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
</x-app-layout>
