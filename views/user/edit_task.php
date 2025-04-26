<form method="POST" action="?page=edit_task&id=<?= $task['id'] ?>">
    <label>Start Time</label><br>
    <input type="datetime-local" name="start_time" value="<?= date('Y-m-d\TH:i', strtotime($task['start_time'])) ?>" required><br><br>

    <label>Stop Time</label><br>
    <input type="datetime-local" name="stop_time" value="<?= date('Y-m-d\TH:i', strtotime($task['stop_time'])) ?>" required><br><br>

    <label>Notes</label><br>
    <textarea name="notes"><?= htmlspecialchars($task['notes']) ?></textarea><br><br>

    <label>Description</label><br>
    <textarea name="description" required><?= htmlspecialchars($task['description']) ?></textarea><br><br>

    <button type="submit">Update</button>
</form>