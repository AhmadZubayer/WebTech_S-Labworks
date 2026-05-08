<section id="update-book-section" class="form-section" style="display: none;">
    <div class="container-card">
        <h2>Update Book Details</h2>
        <form id="update-book-form">
            <!-- Hidden input for book ID -->
            <input type="hidden" id="update-id" name="id">

            <div class="form-group">
                <label for="update-title">Book Title:</label>
                <input type="text" id="update-title" name="title" required placeholder="Enter book title">
            </div>

            <div class="form-group">
                <label for="update-author">Author Name:</label>
                <input type="text" id="update-author" name="author" required placeholder="Enter author name">
            </div>

            <div class="form-group">
                <label for="update-category">Category:</label>
                <select id="update-category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="Science">Science</option>
                    <option value="Fiction">Fiction</option>
                    <option value="History">History</option>
                    <option value="Technology">Technology</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="update-availability">Availability Status:</label>
                <select id="update-availability" name="availability" required>
                    <option value="Available">Available</option>
                    <option value="Not Available">Not Available</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="submit-btn">Update Book</button>
                <button type="button" class="cancel-btn" id="cancel-update">Cancel</button>
            </div>
            <div id="update-book-message" class="message"></div>
        </form>
    </div>
</section>
