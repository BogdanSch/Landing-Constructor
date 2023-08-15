$(document).ready(function() {
    $("#addBlockButton").click(function(event) {
        event.preventDefault();
        let htmlContent = `
            <div class="blocks__item">
                <label class="m-1">Choose your block type*</label>
                <select class="form-select" name="blockType${$(".blocks__item").length + 1}" required>
                    <option value="heading">Heading</option>    
                    <option value="paragraph">Paragraph</option>
                    <option value="image">Image</option>
                    <option value="form">Form</option>
                    <option value="accordion">Accordion</option>
                </select>
            </div>
        `;
        $(".generator__form-options").append(htmlContent);
    });
});