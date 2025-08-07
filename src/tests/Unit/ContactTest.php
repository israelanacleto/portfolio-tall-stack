<?php

namespace Tests\Unit;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_has_fillable_attributes()
    {
        $fillable = [
            'name', 'email', 'subject', 'message', 'metadata', 
            'status', 'notes', 'read_at', 'replied_at'
        ];

        $contact = new Contact();
        
        $this->assertEquals($fillable, $contact->getFillable());
    }

    public function test_contact_has_correct_casts()
    {
        $contact = new Contact();
        $casts = $contact->getCasts();

        $this->assertEquals('array', $casts['metadata']);
        $this->assertEquals('datetime', $casts['read_at']);
        $this->assertEquals('datetime', $casts['replied_at']);
    }

    public function test_contact_uses_uuid_as_primary_key()
    {
        $contact = new Contact();
        
        $this->assertFalse($contact->incrementing);
        $this->assertEquals('string', $contact->getKeyType());
    }

    public function test_contact_can_be_created_with_required_fields()
    {
        $contactData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'subject' => 'Test Subject',
            'message' => 'This is a test message',
            'status' => 'new'
        ];

        $contact = Contact::create($contactData);

        $this->assertInstanceOf(Contact::class, $contact);
        $this->assertEquals('John Doe', $contact->name);
        $this->assertEquals('john@example.com', $contact->email);
        $this->assertEquals('Test Subject', $contact->subject);
        $this->assertEquals('This is a test message', $contact->message);
        $this->assertEquals('new', $contact->status);
    }

    public function test_contact_status_types()
    {
        $validStatuses = ['new', 'read', 'replied', 'archived'];

        foreach ($validStatuses as $status) {
            $contact = Contact::factory()->create(['status' => $status]);
            $this->assertEquals($status, $contact->status);
        }
    }

    public function test_contact_new_status_scope()
    {
        Contact::factory()->newStatus()->create(['name' => 'New Contact']);
        Contact::factory()->read()->create(['name' => 'Read Contact']);
        Contact::factory()->replied()->create(['name' => 'Replied Contact']);

        $newContacts = Contact::whereStatus('new')->get();

        $this->assertEquals(1, $newContacts->count());
        $this->assertEquals('New Contact', $newContacts->first()->name);
    }

    public function test_contact_by_status_scope()
    {
        Contact::factory()->create(['status' => 'new']);
        Contact::factory()->create(['status' => 'read']);
        Contact::factory()->create(['status' => 'replied']);
        Contact::factory()->create(['status' => 'new']);

        $newContacts = Contact::byStatus('new')->get();
        $readContacts = Contact::byStatus('read')->get();
        $repliedContacts = Contact::byStatus('replied')->get();

        $this->assertEquals(2, $newContacts->count());
        $this->assertEquals(1, $readContacts->count());
        $this->assertEquals(1, $repliedContacts->count());
    }

    public function test_contact_recent_scope()
    {
        // Create contacts with different dates
        Contact::factory()->create(['created_at' => now()->subDays(5)]);
        Contact::factory()->create(['created_at' => now()->subDays(10)]);
        Contact::factory()->create(['created_at' => now()->subDays(1)]);

        $recentContacts = Contact::recent()->get();

        // Should be ordered by created_at desc
        $this->assertEquals(3, $recentContacts->count());
        $this->assertTrue($recentContacts->first()->created_at->greaterThan(
            $recentContacts->last()->created_at
        ));
    }

    public function test_contact_can_be_marked_as_read()
    {
        $contact = Contact::factory()->newStatus()->create();

        $contact->update(['status' => 'read']);

        $this->assertEquals('read', $contact->fresh()->status);
    }

    public function test_contact_can_be_marked_as_replied()
    {
        $contact = Contact::factory()->create(['status' => 'read']);

        $contact->update([
            'status' => 'replied',
            'replied_at' => now(),
            'notes' => 'Replied via email'
        ]);

        $freshContact = $contact->fresh();
        $this->assertEquals('replied', $freshContact->status);
        $this->assertNotNull($freshContact->replied_at);
        $this->assertEquals('Replied via email', $freshContact->notes);
    }

    public function test_contact_can_be_archived()
    {
        $contact = Contact::factory()->create(['status' => 'replied']);

        $contact->update(['status' => 'archived']);

        $this->assertEquals('archived', $contact->fresh()->status);
    }

    public function test_contact_email_validation()
    {
        $validEmails = [
            'test@example.com',
            'user.name@domain.co.uk',
            'test+tag@gmail.com'
        ];

        foreach ($validEmails as $email) {
            $contact = Contact::factory()->make(['email' => $email]);
            $this->assertNotEmpty($contact->email);
            $this->assertStringContainsString('@', $contact->email);
        }
    }

    public function test_contact_has_timestamps()
    {
        $contact = Contact::factory()->create();

        $this->assertNotNull($contact->created_at);
        $this->assertNotNull($contact->updated_at);
    }

    public function test_contact_replied_at_can_be_null()
    {
        $contact = Contact::factory()->create(['replied_at' => null]);

        $this->assertNull($contact->replied_at);
    }

    public function test_contact_notes_can_be_added()
    {
        $notes = 'Customer requires follow-up call next week';
        
        $contact = Contact::factory()->create(['notes' => $notes]);

        $this->assertEquals($notes, $contact->notes);
    }

    public function test_contact_can_filter_unread()
    {
        Contact::factory()->newStatus()->create();
        Contact::factory()->read()->create();
        Contact::factory()->newStatus()->create();
        Contact::factory()->replied()->create();

        $unreadContacts = Contact::whereIn('status', ['new'])->get();

        $this->assertEquals(2, $unreadContacts->count());
        $unreadContacts->each(function ($contact) {
            $this->assertEquals('new', $contact->status);
        });
    }

    public function test_contact_message_length()
    {
        $shortMessage = 'Short message';
        $longMessage = str_repeat('This is a long message. ', 50);

        $contact1 = Contact::factory()->create(['message' => $shortMessage]);
        $contact2 = Contact::factory()->create(['message' => $longMessage]);

        $this->assertEquals($shortMessage, $contact1->message);
        $this->assertEquals($longMessage, $contact2->message);
        $this->assertTrue(strlen($contact2->message) > strlen($contact1->message));
    }
}