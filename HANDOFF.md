# Blessings App — Session Handoff

> **Purpose:** This file carries the full context of the "Blessings App" project from the planning session (in the `madeinjlm` repo) into a fresh session on the `shoshiro/blessing` repo. It is self-contained — everything needed to continue is here. Paste this file (or its path) into the new session to resume.

**Date of handoff:** 2026-07-03
**Working title:** "Blessings App" (final name still TBD — see Naming section)
**Prior planning branch:** `claude/claude-md-memory-myrv3t` in `shoshiro/madeinjlm` (PR #1)
**Full planning artifacts location:** `madeinjlm` repo → `_bmad-output/planning-artifacts/briefs/brief-remi-2026-06-18/` (brief.md, addendum.md, .decision-log.md)

---

## 1. What the product is (one paragraph)

A guided blessing-collection platform for life's emotional milestones. When a family marks a moment — a birth, birthday, graduation, wedding, or a child leaving for the army — the app gives the people who matter a simple, guided way to record a short video or spoken blessing. A warm **interviewer persona** walks each contributor through a few thoughtful questions (one at a time), turning a blank-page "say something nice" into a structured ~90-second piece. The host gets a curated, beautiful collection they can watch that night, share with family who couldn't attend, and keep forever. Over time families build a **Thread** — a living timeline of blessings that spans years. Some blessings can be **sealed** and opened at a future milestone (recorded at a birth, unlocked at a bar mitzvah).

## 2. Strategy in one line

**Universal product, focused go-to-market.** The engine is milestone-agnostic (any family, any culture). Launch by going deep on **Jewish lifecycle events**, leveraging the founder's warm NYC Upper East Side network. English-first, full Hebrew support. Win the wedge, then widen.

## 3. Core mechanic (the differentiator)

- **The interview flow:** sequential, one-question-at-a-time prompts. Contributor records a short video/voice/text answer to each. Clips auto-stitched with title cards. **No AI editing required for MVP.**
- **Structured clip storage:** every answer stored as a discrete clip tagged by question / contributor / relationship / milestone. This is the quiet superpower — years later the app can assemble "your mother answering the same question across five milestones." (The montage render itself is a v2 feature; the MVP just captures the structured data.)
- Questions are relationship-aware (grandparent ≠ friend), event-specific, and bilingual (Hebrew/English).

## 4. Tech stack (from founder's CLAUDE.md defaults)

- **Frontend/app:** Next.js
- **Backend/DB:** Supabase
- **Hosting:** Vercel
- **Payments:** Stripe (USD for the NYC launch market; Israeli rails like Tranzila/Bit/Paybox are for later Israel phase)
- **Voice (v2 only):** ElevenLabs (Hebrew/English voice cloning for the conversational AI interviewer)
- **Build tooling:** Claude Code

## 5. MVP scope

**In:**
- Create a family Thread and milestones within it
- Shareable link + QR code for contribution
- "Key contributors" invitation flow (5–10 priority people with personal nudges)
- Guided interview flow (sequential prompts; video/voice/text answer per question; clips auto-stitched with title cards)
- Guided question sets (Hebrew + English), relationship-aware, for: birth/bris/simchat bat, birthday, graduation, bar/bat mitzvah, army enlistment (גיוס)
- Video upload **from camera roll** (NOT in-browser recording — unreliable on mobile), voice recording, text input
- Structured clip storage (tagged by question/contributor/relationship/milestone)
- Immediate collection view for the host
- Optional sealed content with milestone-based unlock
- Downloadable export (paid tiers): zip with videos + transcript + PDF timeline with question context and contributor attribution
- Mobile-first responsive web app
- Stripe payment integration

**Out (deliberately deferred):**
- Conversational AI voice interviewer + automated video editing (the v2 "wow"; ElevenLabs)
- Longitudinal montage auto-generation (data model supports it; render comes later)
- In-browser video recording
- Thread merging at marriage
- Real-time event screen ("The Room")
- Physical printed keepsake book
- Native mobile apps
- Shiva/memorial use case (avoid Empathy's bereavement lane — founder constraint)
- Synagogue/B2B partnerships (wrong sales motion for solo founder at ~5 hrs/week)
- Annual subscription (doesn't match infrequent usage; revisit if repeat usage proves strong)

## 6. Revenue model — per-milestone pricing

| Tier | Price | Includes |
|---|---|---|
| **Free** | $0 | 1 milestone, up to 5 contributors, text-only, basic interview questions |
| **Milestone** | $29 | 1 milestone, unlimited contributors, video/voice/text, full guided interview, downloadable collection |
| **Thread** | $79 | Up to 5 milestones, timeline view, sealed content, future milestone scheduling |
| **Legacy** | $149 | Unlimited milestones, premium unsealing experience, printed keepsake option |

Rationale: milestones are infrequent (1–3/yr), so subscription would charge for quiet months. Per-milestone matches the moment of value.

## 7. Success criteria

**Year 1 (validation):** 30 paid milestones; avg 6+ blessings per milestone; >50% of video blessings 30+ sec; >80% host "would use again"; 5+ families seal content; 3+ organic referrals.
**Year 2 (repeat/growth):** 10+ families return for a 2nd milestone; first sealed content unsealed; first longitudinal montage delivered; $10K–$20K ARR run rate.

## 8. Naming — STILL OPEN (parked)

Name is **not decided**. "Blessings App" is a placeholder. 50+ candidates explored across many rounds; the memory/family app space has consumed most evocative English words. Key rejections so far:

- **Simcha** — taken (Simcha AI therapy app, trademark filing, "Sharing Simcha" competitor).
- **Remi** — blocked. remi.app is a near-identical AI memory product (Brightful Corp), though small/pre-launch.
- **Someday** — loved emotionally, but "Someday - Diary App" exists + all domains taken. (The diary app is just a date-countdown tracker, NOT a real product competitor — but the name is taken.)
- **OneDay** — blocked AND it's a near-clone: an existing "OneDay" app does the exact interview→stitch→movie mechanic for kids/grandparents/weddings. (Old, iOS-only, no sealed content/Thread/bilingual — validates the mechanic but kills the name.)
- **Everly** — blocked. "Everly App" + "Talk With Everly" both active family-memory products.
- **Spark** — saturated (Spark Mail, Apache Spark, "Spark - Goal Tracker" in same space).
- **Flame** — available in-category but reads hot/intense, not tender; weak as a persona name.
- **Catchlight** — no in-category app, but two established orgs own it (Catchlight.ai wealth-mgmt, CatchLight.io journalism nonprofit); .ai/.io gone, SEO claimed.
- **Everkept** — CLEAN in-category (only "EverKept Disposal", unrelated); likely-available domains; meaning (ever + kept) fits. **Current leading candidate — pending deeper domain/USPTO check.**
- Many coined options rejected by founder (Vowen, Yearnly, Emberly, Member, Lumora, Cheri, Endear, etc.).

**Recommended approach:** don't force it. Ship the product under the placeholder; the name will surface once it's real. If a name is wanted before launch, **run a deep availability + USPTO pass on "Everkept"** first.

## 9. Founder constraints (from CLAUDE.md — respect these)

- Solo founder, ~5 evening hours/week. Bias to shipping.
- Wants recurring revenue from customers with real disposable income; digital, scalable.
- Based in Modi'in, Israel; Hebrew-native; NYC UES Jewish network as GTM wedge.
- **Cannot build anything conflicting with current employment** (fraud/risk scoring as a product) while employed.
- **Avoid the bereavement lane** (owned by Empathy / Ron Gura).
- No consulting or community management (too time-intensive).

## 10. Recommended next steps (in the `blessing` repo)

1. **Land the planning docs.** Copy the brief/addendum/decision-log from `madeinjlm` into the new repo (e.g. under `docs/` or `_planning/`), plus a project-specific `CLAUDE.md`.
2. **Write the PRD.** Use the BMAD `bmad-prd` skill (BMAD is installed in `madeinjlm`; may need reinstalling in `blessing` via `npx bmad-method install`). Turn this brief into detailed requirements.
3. **Architecture pass.** Data model is the crux — design the schema around **structured clips** (question, contributor, relationship, milestone, thread, seal-until-date) so the longitudinal-montage future is preserved. Next.js + Supabase (Postgres + Storage for media + Auth) + Vercel + Stripe.
4. **Scaffold the app.** Next.js app, Supabase project, auth, milestone creation, contributor invite flow (link + QR), the sequential interview UI, camera-roll upload, host collection view.
5. **Validation in parallel (non-code):** 10 interviews with NYC-network parents who hosted a milestone in the last 12 months. Ask what they wish they'd captured, what they lost, what they'd pay. Listen for hesitation, not enthusiasm.

## 11. How to bring over the full planning artifacts

The complete, longer-form documents live in the `madeinjlm` repo on branch `claude/claude-md-memory-myrv3t` (PR #1):
- `_bmad-output/planning-artifacts/briefs/brief-remi-2026-06-18/brief.md` — full product brief
- `.../addendum.md` — competitive landscape (30+ products, 5 categories, pricing tables), lifecycle timeline, guided-script examples
- `.../.decision-log.md` — full audit trail of every decision incl. adversarial-review findings

Copy those three files into the new repo, or reference them from the branch. This HANDOFF.md summarizes them but the originals have more depth (especially the competitive tables and the 4 draft interview scripts).
