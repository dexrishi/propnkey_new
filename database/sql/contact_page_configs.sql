-- SQL to ensure all contact page configuration fields exist in site_configs table
-- Run this SQL if any of these fields are missing

-- Insert or update company_name
INSERT INTO `site_configs` (`label`, `type`, `content`, `description`, `created_at`, `updated_at`)
VALUES ('company_name', 'text', 'Luxury Residences Real Estate LLC', 'Company name displayed on contact page', NOW(), NOW())
ON DUPLICATE KEY UPDATE `updated_at` = NOW();

-- Insert or update contact_phone (office phone)
INSERT INTO `site_configs` (`label`, `type`, `content`, `description`, `created_at`, `updated_at`)
VALUES ('contact_phone', 'text', '+971 4 283 6681', 'Office phone number for contact page', NOW(), NOW())
ON DUPLICATE KEY UPDATE `updated_at` = NOW();

-- Insert or update contact_email
INSERT INTO `site_configs` (`label`, `type`, `content`, `description`, `created_at`, `updated_at`)
VALUES ('contact_email', 'text', 'contactus@luxuryresidences.com', 'Contact email address', NOW(), NOW())
ON DUPLICATE KEY UPDATE `updated_at` = NOW();

-- Insert or update office_address
INSERT INTO `site_configs` (`label`, `type`, `content`, `description`, `created_at`, `updated_at`)
VALUES ('office_address', 'textarea', 'Office 410, The Onyx Tower 2<br>The Greens, Dubai, UAE,<br>P.O. Box 451733', 'Office address for contact page (HTML allowed)', NOW(), NOW())
ON DUPLICATE KEY UPDATE `updated_at` = NOW();

-- Insert or update facebook_url
INSERT INTO `site_configs` (`label`, `type`, `content`, `description`, `created_at`, `updated_at`)
VALUES ('facebook_url', 'text', '#', 'Facebook page URL', NOW(), NOW())
ON DUPLICATE KEY UPDATE `updated_at` = NOW();

-- Insert or update instagram_url
INSERT INTO `site_configs` (`label`, `type`, `content`, `description`, `created_at`, `updated_at`)
VALUES ('instagram_url', 'text', '#', 'Instagram profile URL', NOW(), NOW())
ON DUPLICATE KEY UPDATE `updated_at` = NOW();

-- Insert or update linkedin_url
INSERT INTO `site_configs` (`label`, `type`, `content`, `description`, `created_at`, `updated_at`)
VALUES ('linkedin_url', 'text', '#', 'LinkedIn profile URL', NOW(), NOW())
ON DUPLICATE KEY UPDATE `updated_at` = NOW();

-- Insert or update youtube_url
INSERT INTO `site_configs` (`label`, `type`, `content`, `description`, `created_at`, `updated_at`)
VALUES ('youtube_url', 'text', '#', 'YouTube channel URL', NOW(), NOW())
ON DUPLICATE KEY UPDATE `updated_at` = NOW();

-- Insert or update twitter_url
INSERT INTO `site_configs` (`label`, `type`, `content`, `description`, `created_at`, `updated_at`)
VALUES ('twitter_url', 'text', '#', 'Twitter profile URL', NOW(), NOW())
ON DUPLICATE KEY UPDATE `updated_at` = NOW();

-- Insert or update tiktok_url (if needed)
INSERT INTO `site_configs` (`label`, `type`, `content`, `description`, `created_at`, `updated_at`)
VALUES ('tiktok_url', 'text', '#', 'TikTok profile URL', NOW(), NOW())
ON DUPLICATE KEY UPDATE `updated_at` = NOW();

-- Insert or update recaptcha_site_key
INSERT INTO `site_configs` (`label`, `type`, `content`, `description`, `created_at`, `updated_at`)
VALUES ('recaptcha_site_key', 'text', '6LfSnNkrAAAAAOikQGl3aBi8BK_g4wBEDtSx86O2', 'Google reCAPTCHA v2 Site Key', NOW(), NOW())
ON DUPLICATE KEY UPDATE `updated_at` = NOW();

-- Insert or update recaptcha_secret_key (for server-side validation)
INSERT INTO `site_configs` (`label`, `type`, `content`, `description`, `created_at`, `updated_at`)
VALUES ('recaptcha_secret_key', 'text', '', 'Google reCAPTCHA v2 Secret Key (for server-side validation)', NOW(), NOW())
ON DUPLICATE KEY UPDATE `updated_at` = NOW();

