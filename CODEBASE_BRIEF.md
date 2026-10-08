# OrgInsights App — Codebase Brief

Recovered from the `orginsight-sandbox` Linode clone (Ubuntu 20.04, Apache + PHP 8.0.14 + MySQL 8.0.42), 2026-09-29. Code extracted to `app-code/app.orginsights.io/`; database dumped to `orginsights-db.sql.gz` (56 tables). Read-only review — nothing was modified.

## 1. Architecture

**Framework: CodeIgniter 3.1.11** (`system/core/CodeIgniter.php` → `CI_VERSION = '3.1.11'`). PHP requirement per `composer.json` is only `>=5.3.7`, but the server actually runs **PHP 8.0.14** — CI 3.1.11 predates official PHP 8 support (that landed in 3.1.13), so the app is running on borrowed time with deprecation warnings suppressed (`error_reporting(0)` in the scoring scripts).

**Entry point:** `index.php` → CodeIgniter front controller. Default route is `welcome` (`application/config/routes.php`); URL pattern is the standard CI3 `example.com/class/method/id/`. There is **no `.htaccess`-based URL rewriting evidence of REST** — it's classic CI3 page-per-controller.

**`application/` layout (standard CI3, with quirks):**
- `application/controllers/` — **51 controllers**. The big ones: `Selfassessment.php` (1,100+ lines, the whole assessment flow), `Report360.php`, `Reports360.php`, `Report.php`, `Finalreport*.php` (5 variants: `Finalreport`, `Finalreportc/d/e/perc`), `Checkout.php` (Stripe), `Register.php` (1,000+ lines), `Login.php`, `Forgotpassword.php`, `Industryreport(s).php`, `Orgreport(s).php`, `Downloadpdf.php`, `Pdfreport.php`, `Showpdf.php`, `Assessment.php`, `Thirdparty.php`, plus oddities: `Checkout - Copy.php`, `Test.php`, `Testcalendly.php`, `fixgroupby.php`, `Csv_todb.php`.
- `application/models/` — **exactly one model**: `Site_usersModel.php` (26 lines, one method `check_user_existance`). Almost all data access is raw SQL via `$this->db->query(...)` inside controllers.
- `application/views/` — **146 views**, many duplicated with ` - Copy` suffixes (`CheckCompletion - Copy.php`, `filtersc - Copy.php`, `Checkout - Copy.php`), suggesting copy-paste iteration instead of version control. There is also `application/backupviews/`.
- `application/config/database.php` — hardcoded credentials: user `shahidj`, db `orginsights`, localhost.

**The non-framework half (the important part):** the document root also contains ~20 standalone procedural PHP scripts that **bypass CodeIgniter entirely** and talk to MySQL directly via `connection.php` (`new mysqli('localhost','shahidj','Ecnet!23','orginsights')` — credentials hardcoded in plaintext):
- `FR_calc.php` (1,569 lines) — **the scoring engine**. Included by `ajax.php`, `ajax2/3/4.php`, `FR_form_result.php`.
- `FR_check.php`, `FR_graph_result.php` (725 lines), `FR_summary_display.php` (456), `FR_breakdown_display.php` (268), `FR_pop_display.php` (168), `FR_form_result.php` (328) — report rendering fragments (HTML sections, included by AJAX endpoints).
- `put_scores.php` (24 lines) — batch backfill: finds `orders_assessment_type_responses` rows with `oa_val=-99` (unscored), looks up the `Score` in `questions_responses`, and writes it back. Clearly meant to be hit via browser/cron.
- `sendreminders.php` (96 lines) — cron-style reminder mailer for 360 raters (see §2).
- `userscript.php` (337 lines), `statusscript.php` (43), `statusscript2.php` (26) — one-off data-migration scripts (e.g. mapping free-text country/province names to lookup-table IDs; flipping `SelfAssessmentStatus`/`OrgInsightsStatus` flags on orders).
- `ActiveR.php` — toggles `users.is_active` via `$_REQUEST` with **no auth check**.
- `ajax.php`, `ajax2.php`, `ajax3.php`, `ajax4.php` — AJAX endpoints that `include("connection.php")` + `include("FR_calc.php")` then render report HTML sections.
- `citylist.php`, `citylistR.php`, `citylistc.php`, `provincelistR.php`, `changefield.php` — dropdown-population helpers for the registration form.
- `register_optional.php` — legacy jQuery 1.4.2 snippet.
- Root-level `controllers/Selfassessment.php` + `views/{self_assessment,third_party_assessment,closedassessment,home}.php` — **a dead parallel copy**: the root `Selfassessment.php` still does `defined('BASEPATH') OR exit(...)` but is never routed to (CI only loads `application/controllers/`). Leftover from an earlier layout.
- `testpdf/` — a dompdf smoke test (`testpdf/index.php` builds a "Copyrights 2021 Orginsights" PDF).
- `calendar/` — unused-looking helper dir.

**`appAdmin/`** — a **second complete CodeIgniter install** (own `application/`, `system/`, `index.php`) serving as the back-office admin panel: controllers for `Dashboard`, `Orders`, `Questions`, `Capabilities`, `Categories`, `Assessmentcost(s)`, `Assessmentprice(s)`, `Industrycapabilities`, `Csvimport`, `Frontendreferralmail`, etc. It's how staff manage questions, capabilities, pricing, and orders.

**PHPMailer** — bundled at root (`PHPMailer/`), used by `sendreminders.php` and CI controllers for transactional mail.

## 2. Features (end to end)

1. **Registration / login** — `Register.php` (multi-step: `index` → `optional` → `self`/`professional`/`orginsights`), `Login.php`, `Forgotpassword.php`, Google/Facebook signup (`users.signup_via`, `user_sm_id`). Passwords stored as `char(32)` — i.e. **MD5**.
2. **Checkout** — `Checkout.php` + `StripePayment.php` view; `orders` table with `payment_status`/`order_status`, packages (`packages`, `AssessmentCosts`), referral codes (`ReferralCodes`, `ReferralCodeUses`).
3. **Taking the assessment** — `Selfassessment::index($order_id)`: on POST, each answer arrives as `oatr_id_value` pairs; the controller writes `oa_val` into `orders_assessment_type_responses`, then checks whether any `oa_val=-99` remain for `q_type='self'` to flip `orders.SelfAssessmentStatus`. Flow continues through `professional()` (OrgInsights/peer-rated items) and `thirdparty()` (360 invites).
4. **360 raters** — `add_invite_user`/`show_invited_people` create `invited_users` rows with a `unique_url`; raters answer via `thirdparty_rater`; their answers land in `orders_assessment_type_rater_responses`. `sendreminders.php` emails raters who haven't responded once `FrequencyofReminders` days pass (SMTP via PHPMailer; note the **hardcoded dev paths** `/var/www/html/clients/orginsightapp/...` and `clients.ecnet.dev` URLs — it was built on the dev agency's server and still references it).
5. **Score computation** — `FR_calc.php`: given `user_id` + `order_id` (POST), it (a) builds a population filter `$Popwhereq` from demographic POST filters (country, province, city, age, HLE, university, study, designation, experience level, performance rating, industry, expertise role, salary) defaulting to the user's own country; (b) sums `oa_val` per `cat_id`/`cap_id` over the `View_User_Responses` view (which joins responses→questions→orders, only completed assessments, `oa_val > -99`) — separately for the user's own scores vs the population; (c) does the same for `q_type='professional'` (the OrgInsights/360 side). Question types come from `question_types`: 1=Cognitive, 2=Likert, 3=Other Rater Items, 4=Personality, 5=Self-Rated Items, 6=SJT. Self scores use types (3,5); professional uses the rest. The **Gap Metric** (Hidden Talent vs Blind Spot) is computed in `FR_summary_display.php`: per category, it compares your self-rating vs the population/peer rating — rating yourself *lower* than others rate you → "Hidden Talent", higher → "Blind Spot". Conditional narrative text comes from `ConditionalComments_Report` (TopScoring/LowestScoring/HiddenTalent/BlindSpot columns per category).
6. **Report rendering** — `FR_graph_result.php` (charts + per-capability bars), `FR_summary_display.php`, `FR_breakdown_display.php`, `FR_pop_display.php`, served through `ajax*.php` / `FR_form_result.php` and the `Report*`/`Finalreport*` controllers. Benchmarks: population averages, industry best-fit (`IndustryCapabilities`, `IndustryLevels`), career-tier benchmarks.
7. **PDF** — `Downloadpdf.php` serves pre-generated PDFs from `assets/reports/<filename>.pdf` (the 1.6 GB of generated reports on the server — excluded from this extraction); `Pdfreport.php`/`Showpdf.php` are the on-screen report views. Generation itself appears to be a browser print-to-PDF flow saved server-side (no server-side generator wired into the report controllers; dompdf exists in `vendor/` but only the `testpdf/` smoke test uses it).
8. **Admin** — `appAdmin/` CRUD for questions, capabilities, categories, pricing, orders, industry mappings, CSV import.

## 3. Data model (key tables in `orginsights` DB)

- `users` — profile + demographics (name, email, MD5 `password`, country/province/city IDs, age_range, hle, university, program_study, designation, industry_employer, salary_range, `signup_via`, `is_active`, …).
- `orders` — purchases (`user_id`, totals, `payment_status`, `order_status`, `order_package_id`, `unique_order_code`, `SelfAssessmentStatus`, `OrgInsightsStatus` flags).
- `orders_assessment_type` — one row per assessment type per order (`Self Assessment` / `OrgInsights Assessment` / `360 Assessment`, status Initiate→In Process→Completed).
- `orders_assessment_type_responses` — **the answer store**: (`oat_id`, `order_id`, `user_id`, `q_id`, `oa_id`, `oa_val` default **-99** = unanswered/unscored).
- `orders_assessment_type_rater_responses` — same shape for 360 raters, keyed by `r_user_id` → `invited_users.id`.
- `questions` — (`q_id`, `question`, `cat_id`, `cap_id`, `q_type` ∈ self/professional/'other rated', `question_typeID`).
- `questions_responses` — answer-option → score map (`q_id`, `oa_id`, `Score`); this is what `put_scores.php` uses to resolve `oa_val`.
- `responses` (`oa_id`, `answers`) — answer option text.
- `capabilities` (`cap_id`, `cap_name`, `description`) — the 22 soft skills; `categories` (`cat_id`, `cat_name`) — the 5 LEADS pillars.
- `invited_users` — 360 rater invites (`order_id`, `unique_url`, `invite_sent`, `isOpen`, `FrequencyofReminders`, `LengthofAssessment`).
- `View_User_Responses` / `View_User_Responses_360` — MySQL views joining responses→questions→orders, filtering to scored, completed assessments; **the entire scoring engine reads through these**.
- Supporting lookups: `countries/provinces/Cities`, `universities`, `industry`, `Designations`, `AgeRanges`, `SalaryRanges`, `MostRecentExperienceLevel`, `Performance_Rating`, `Expertise_Role`, `HLEType`, `study`, `packages`, `AssessmentCosts`, `ReferralCodes`, `Mail_messages`, `ConditionalComments_Report`, `IndustryCapabilities(1)`, `IndustryLevels`, `certificate`, `companies`, `currencycodes`, `canadauniversity`, `LocalAmazon`, plus duplicates (`countries0`, `provinces0`, `Cities0`, `universitybycountry`, `countriesx`, `provincesx`) and a legacy `scores` table.

## 4. Third-party dependencies

- `vendor/` (composer): **dompdf/dompdf** (+ `phenx/svgo-php`, `sabberworm/php-css-parser` as its deps) — installed but only exercised by `testpdf/`; the real report PDFs are pre-generated files.
- `PHPMailer/` at root — used for all transactional/reminder mail.
- `composer.json` at root is actually **CodeIgniter's own** (the framework was dropped in, not composer-managed for app deps).
- Front end (from views): Bootstrap-style markup, jQuery (including a 1.4.2-era snippet in `register_optional.php`), Google Fonts (Montserrat/Roboto in PDF template). No build step, no package.json.

## 5. Notable observations (for redesign)

1. **Two apps in one docroot**: the CI3 framework app *and* ~20 procedural scripts sharing the DB via two separate hardcoded credential spots (`application/config/database.php` and `connection.php`). Any credential rotation must hit both. The FR_*.php scripts also bypass CI's session/auth — `ActiveR.php` mutates `users.is_active` from `$_REQUEST` with zero authentication.
2. **Duplicate everything**: root `controllers/`+`views/` mirror of CI controllers (dead code), five `Finalreport*` controller variants, ` - Copy` view/controller files, `application/backupviews/`, duplicate lookup tables (`countries`/`countries0`/`countriesx`). No `.git` anywhere — no version control history.
3. **Scoring is presentation-layer SQL**: `FR_calc.php` builds the population benchmark with string-concatenated SQL and ~1,500 lines of inline HTML/PHP. Business logic, queries, and markup are inseparable — the highest-value refactor target.
4. **Hardcoded environment**: absolute paths (`/var/www/html/clients/orginsightapp/`, `/var/www/html/app.orginsights.io/`), dev-server URLs (`clients.ecnet.dev`), SMTP sender (`dev@ecnetsolutions.ca`). Moving hosts requires a find-replace sweep.
5. **PHP 8.0 on CI 3.1.11**: works today only because errors are suppressed; upgrading PHP or enabling error reporting will surface deprecations. CI3 itself is EOL.
6. **Security debt**: MD5 passwords (`users.password char(32)`), `error_reporting(0)` hiding failures, raw `$_POST` interpolation into SQL in several scripts (some cast to `(int)`, some don't — e.g. `userscript.php` interpolates names directly), no CSRF tokens visible, `oa_val=-99` sentinel for "unscored".
7. **Data worth preserving**: `questions` + `questions_responses` (the validated item bank and scoring key), `capabilities`/`categories` (the LEADS model), `ConditionalComments_Report` (report narratives), the two views (scoring semantics), and the 1.6 GB `assets/reports/` PDFs (not yet extracted).
8. **The good news**: the domain model is clean and small (users → orders → assessment types → responses → questions → capabilities/categories), the 360 flow is fully functional, and the scoring math is straightforward sums/benchmarks — very portable to a modern stack.
