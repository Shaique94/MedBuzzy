# Contact Details Usage Guide

This guide explains how to use contact details throughout the MedBuzzy application.

## Environment Variables

The following environment variables are available in `.env`:

```env
CONTACT_ADDRESS="123 Main Street, City, Country"
CONTACT_PHONE="+1 234 567 890"
CONTACT_EMAIL="contact@medbuzzy.com"
CONTACT_WORKING_HOURS="Mon-Fri: 9:00 AM - 6:00 PM"
CONTACT_EMERGENCY_PHONE="+1 234 567 891"
```

## Usage Methods

### 1. Using ContactService (Recommended)

```php
use App\Services\ContactService;

// Get all contact details
$contactDetails = ContactService::getContactDetails();

// Get specific details
$email = ContactService::getEmail();
$phone = ContactService::getPhone();
$address = ContactService::getAddress();
$workingHours = ContactService::getWorkingHours();
$emergencyPhone = ContactService::getEmergencyPhone();

// Get any specific detail by key
$detail = ContactService::getContactDetail('email');
```

### 2. Using Config Helper

```php
// Get all contact details
$contactDetails = config('contact');

// Get specific details
$email = config('contact.email');
$phone = config('contact.phone');
```

### 3. In Blade Templates

#### Using Global Variable (Available in all views)
```blade
{{ $contact['email'] }}
{{ $contact['phone'] }}
{{ $contact['address'] }}
```

#### Using Blade Directive
```blade
@contact('email')
@contact('phone')
@contact('address')
```

#### Using Config Helper
```blade
{{ config('contact.email') }}
{{ config('contact.phone') }}
```

### 4. In Livewire Components

```php
use App\Services\ContactService;

class YourComponent extends Component
{
    public function render()
    {
        return view('your-view', [
            'contactDetails' => ContactService::getContactDetails()
        ]);
    }
}
```

### 5. In Controllers

```php
use App\Services\ContactService;

class YourController extends Controller
{
    public function index()
    {
        $contactDetails = ContactService::getContactDetails();
        
        return view('your-view', compact('contactDetails'));
    }
}
```

## Examples

### Contact Page Component
```php
// In ContactUs.php component
public function render()
{
    return view('livewire.public.contact.contact-us', [
        'contactDetails' => ContactService::getContactDetails()
    ]);
}
```

### Footer Component
```blade
<!-- In footer.blade.php -->
<footer>
    <p>Contact us: <a href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a> | <a href="tel:{{ $contact['phone'] }}">{{ $contact['phone'] }}</a></p>
    <p>Address: {{ $contact['address'] }}</p>
</footer>
```

### Email Templates
```blade
<!-- In email templates -->
<p>If you have questions, contact us at <a href="mailto:{{ config('contact.email') }}">{{ config('contact.email') }}</a></p>
<p>Or call us at <a href="tel:{{ config('contact.phone') }}">{{ config('contact.phone') }}</a></p>
```

### Contact Links
```blade
<!-- Clickable phone number -->
<a href="tel:{{ $contact['phone'] }}" class="hover:text-blue-600">{{ $contact['phone'] }}</a>

<!-- Clickable email -->
<a href="mailto:{{ $contact['email'] }}" class="hover:text-blue-600">{{ $contact['email'] }}</a>

<!-- Emergency phone -->
<a href="tel:{{ $contact['emergency_phone'] }}" class="text-red-600">Emergency: {{ $contact['emergency_phone'] }}</a>
```

## Best Practices

1. **Use ContactService**: Always use the ContactService class for consistency
2. **Global Access**: Contact details are available globally in all views via `$contact` variable
3. **Fallback Values**: All methods have fallback values in case environment variables are not set
4. **Caching**: Config values are cached in production for better performance
5. **Type Safety**: Use the specific methods like `getEmail()` for better IDE support
6. **Clickable Links**: Use `mailto:` and `tel:` links for better user experience
   - `tel:` links allow users to call directly from mobile devices
   - `mailto:` links open the user's default email client
   - Both improve accessibility and user experience

## Configuration File

Contact details are configured in `config/contact.php` which reads from environment variables:

```php
return [
    'address' => env('CONTACT_ADDRESS', 'Default Address'),
    'phone' => env('CONTACT_PHONE', 'Default Phone'),
    'email' => env('CONTACT_EMAIL', 'default@email.com'),
    'working_hours' => env('CONTACT_WORKING_HOURS', 'Default Hours'),
    'emergency_phone' => env('CONTACT_EMERGENCY_PHONE', 'Default Emergency'),
];
```
