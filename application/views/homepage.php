<div class="alert alert-info">{remaining_tasks} tasks are left to do!</div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <td><strong>ID</strong></td>
                <td><strong>TASK</strong></td>
                <td><strong>PRIORITY</strong></td>
            </tr>
        </thead>
        <tbody>
            {display_tasks}
            <tr>
                <td>{id}</td>
                <td>{task}</td>
                <td>{priority}</td>
            </tr>
            {/display_tasks}
        </tbody>
    </table>
</div>
</div>
