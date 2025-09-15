/**
 * Plugin Name Admin JavaScript
 */

jQuery(document).ready(function($) {
    // Handle copy button clicks using data attributes
    $(document).on('click', '.copy-btn', function(e) {
        e.preventDefault();
        
        const button = $(this);
        const textToCopy = button.data('copy-text');
        
        if (!textToCopy) {
            console.error('No copy text found');
            return;
        }
        
        // Create a temporary textarea element
        const textarea = document.createElement('textarea');
        textarea.value = textToCopy;
        textarea.style.position = 'fixed';
        textarea.style.opacity = '0';
        textarea.style.left = '-9999px';
        document.body.appendChild(textarea);
        
        // Select and copy the text
        textarea.select();
        textarea.setSelectionRange(0, 99999); // For mobile devices
        
        try {
            const successful = document.execCommand('copy');
            
            if (successful) {
                const originalContent = button.html();
                button.addClass('copied');
                button.html('کپی شد!');
                
                // Reset button after 2 seconds
                setTimeout(() => {
                    button.removeClass('copied');
                    button.html(originalContent);
                }, 2000);
                
                // Show success message
                console.log('کد با موفقیت کپی شد!');
            } else {
                throw new Error('Copy command failed');
            }
        } catch (err) {
            console.error('Failed to copy text: ', err);
            alert('خطا در کپی کردن کد');
        }
        
        // Remove the temporary element
        document.body.removeChild(textarea);
    });
});
