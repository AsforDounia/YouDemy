<form id="ChangeUserForm" action="/admin/ChangeUserRole" method="POST" class="space-y-4">
    <!-- Role -->
    <div>
        <input name="user_id" type="hidden" value=" <?=$data['user_id'] ?>">
        <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
        <div class="relative">
            <select id="role" name="role" class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent appearance-none" required>
                <option value="Student">Student</option>
                <option value="Teacher">Teacher</option>
                <option value="Admin">Admin</option>
            </select>
            <i class="fas fa-user-graduate absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
        </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition-colors flex items-center justify-center space-x-2">
        <span>Change User Role</span>
        <i class="fas fa-arrow-right text-sm"></i>
    </button>
</form>