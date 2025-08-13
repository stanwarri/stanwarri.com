# Personal Community Website Project Plan

## Project Overview
Building a personal community website where books are given to random people with QR codes that link to a community registration form. The system tracks book inventory, distributions, and community member registrations.

## Core Requirements Analysis

### Functional Requirements
1. **Book Inventory Management**: Track books purchased for giveaway
2. **QR Code Generation**: Unique QR codes per book distribution
3. **Book Distribution Tracking**: Record who received which book
4. **Community Registration**: Form for recipients to join community
5. **Public Pages**: Landing page and book showcase
6. **Admin Interface**: Manage all aspects through FilamentPHP

### Technical Requirements
- Laravel 12 backend
- FilamentPHP admin panel
- QR code generation library
- Public web pages for recipients
- Database for tracking all entities

## Database Schema Design

### Tables Needed

#### `books` table
- `id` (primary key)
- `title` (string, required)
- `author` (string, required) 
- `isbn` (string, nullable)
- `description` (text, nullable)
- `cover_image_url` (string, nullable)
- `purchase_date` (date, nullable)
- `purchase_price` (decimal, nullable)
- `quantity_purchased` (integer, default 1)
- `created_at`, `updated_at`

#### `book_distributions` table  
- `id` (primary key)
- `book_id` (foreign key to books)
- `qr_code` (unique string, indexed)
- `distribution_date` (date, nullable)
- `distribution_location` (string, nullable)
- `notes` (text, nullable)
- `status` (enum: 'pending', 'distributed', 'registered')
- `created_at`, `updated_at`

#### `community_members` table
- `id` (primary key)
- `book_distribution_id` (foreign key, nullable)
- `name` (string, required)
- `email` (string, required, unique)
- `phone` (string, nullable)
- `message` (text, nullable)
- `how_found` (string, nullable) 
- `interests` (json, nullable)
- `registered_at` (timestamp)
- `created_at`, `updated_at`

## Feature Implementation Plan

### Phase 1: Core Admin Functionality
**Todo Items:**
- [ ] Create Book model and migration
- [ ] Create BookDistribution model and migration  
- [ ] Create CommunityMember model and migration
- [ ] Set up model relationships
- [ ] Create FilamentPHP Book resource for CRUD operations
- [ ] Create FilamentPHP BookDistribution resource
- [ ] Create FilamentPHP CommunityMember resource (read-only)

### Phase 2: QR Code System
**Todo Items:**
- [ ] Install QR code generation package (endroid/qr-code)
- [ ] Create QR code generation service
- [ ] Add QR code generation to BookDistribution creation
- [ ] Create unique URL structure for each QR code
- [ ] Add bulk QR code generation feature
- [ ] Create printable QR code view/PDF generation

### Phase 3: Public Web Pages
**Todo Items:**
- [ ] Create landing page controller and view
- [ ] Create book showcase page controller and view  
- [ ] Create community registration form controller and view
- [ ] Design responsive layouts with TailwindCSS
- [ ] Implement form validation and submission
- [ ] Add success/error messaging

### Phase 4: Advanced Features
**Todo Items:**
- [ ] Add book cover image upload functionality
- [ ] Implement search and filtering on admin pages
- [ ] Add distribution analytics and reporting
- [ ] Create email notifications for new registrations
- [ ] Add bulk operations for book management
- [ ] Implement data export functionality

## Technical Implementation Details

### QR Code URL Structure
```
https://yoursite.com/join/{unique-qr-code}
```
Each QR code links to a unique URL that pre-fills the community form with book information.

### FilamentPHP Resources

#### BookResource
- **List**: Display title, author, quantity, remaining count
- **Create/Edit**: All book fields with image upload
- **Actions**: Generate QR codes, view distributions

#### BookDistributionResource  
- **List**: Book title, QR code, status, distribution date
- **Create**: Select book, generate QR code, set distribution details
- **Actions**: Print QR code, mark as distributed

#### CommunityMemberResource
- **List**: Name, email, book received, registration date
- **View**: Full member details and associated book
- **Filters**: By book, registration date, status

### Public Pages

#### Landing Page (`/`)
- Hero section about you and your mission
- Statistics (books given, community members)
- Call-to-action to learn more
- Links to book showcase

#### Book Showcase (`/books`)
- Grid/list of books you've given out
- Book covers, titles, brief descriptions
- Number of copies distributed
- Filter by genre/author

#### Community Registration (`/join/{qr-code}`)
- Pre-filled book information
- Registration form fields:
  - Name (required)
  - Email (required) 
  - Phone (optional)
  - Message about the book (optional)
  - How they found the book (optional)
  - Interests/preferences (checkboxes)

### Security Considerations
- Validate QR codes to prevent unauthorized access
- Rate limiting on registration form
- CSRF protection on all forms
- Input sanitization and validation
- Unique QR codes to prevent duplicates

### Performance Optimizations
- Index on QR codes for fast lookups
- Eager loading for book distributions
- Image optimization for book covers
- Caching for public pages

## Development Workflow

### Phase 1 Deliverables (Week 1)
1. Database migrations and models
2. Basic FilamentPHP admin interface
3. CRUD operations for books and distributions

### Phase 2 Deliverables (Week 2)  
1. QR code generation system
2. Unique URL routing
3. Printable QR codes

### Phase 3 Deliverables (Week 3)
1. Public landing page
2. Book showcase page
3. Community registration form

### Phase 4 Deliverables (Week 4)
1. Advanced admin features
2. Analytics and reporting
3. Email notifications
4. Final testing and deployment

## Success Metrics
- Ability to track all book inventory and distributions
- Generate and print QR codes efficiently
- Seamless community member registration process
- Comprehensive admin interface for management
- Professional public-facing website

## Next Steps
1. Review and approve this plan
2. Begin Phase 1 implementation
3. Regular check-ins after each phase
4. Testing and feedback before final deployment

---
*This plan follows the simple, incremental approach outlined in CLAUDE.md - each phase builds upon the previous one with small, manageable changes.*