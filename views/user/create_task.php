<h2>Create Task</h2>
<form method="POST" action="?page=create_task">
    <label>Start Time</label><br>
    <input type="datetime-local" name="start_time" required><br><br>

    <label>Stop Time</label><br>
    <input type="datetime-local" name="stop_time" required><br><br>

    <label>Notes</label><br>
    <textarea name="notes"></textarea><br><br>

    <label>Description</label><br>
    <textarea name="description" required></textarea><br><br>

    <button type="submit">Submit</button>
</form>