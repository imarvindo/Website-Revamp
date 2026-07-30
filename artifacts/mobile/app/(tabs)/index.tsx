import React from 'react';
import {
  ActivityIndicator,
  Image,
  Platform,
  Pressable,
  ScrollView,
  StyleSheet,
  Text,
  View,
} from 'react-native';
import { useColors } from '@/hooks/useColors';
import { useGetAgencyStats, useGetFeaturedContent, useListServices } from '@workspace/api-client-react';
import { Feather, Ionicons } from '@expo/vector-icons';
import { useSafeAreaInsets } from 'react-native-safe-area-context';
import { router } from 'expo-router';
import * as Haptics from 'expo-haptics';

const logoImage = require('@/assets/images/logo.png');

function StatCard({ value, label, color }: { value: string; label: string; color: string }) {
  const colors = useColors();
  return (
    <View style={[styles.statCard, { backgroundColor: colors.card, borderColor: colors.border }]}>
      <Text style={[styles.statValue, { color }]}>{value}</Text>
      <Text style={[styles.statLabel, { color: colors.mutedForeground }]}>{label}</Text>
    </View>
  );
}

function ServiceRow({ item, onPress }: { item: { slug: string; title: string; shortDescription: string; icon: string }; onPress: () => void }) {
  const colors = useColors();
  return (
    <Pressable
      style={({ pressed }) => [
        styles.serviceRow,
        { backgroundColor: colors.card, borderColor: colors.border, opacity: pressed ? 0.75 : 1 },
      ]}
      onPress={onPress}
    >
      <View style={[styles.serviceIconBox, { backgroundColor: colors.secondary }]}>
        <Ionicons name="search" size={18} color={colors.primary} />
      </View>
      <View style={styles.serviceRowContent}>
        <Text style={[styles.serviceRowTitle, { color: colors.foreground }]} numberOfLines={1}>
          {item.title}
        </Text>
        <Text style={[styles.serviceRowDesc, { color: colors.mutedForeground }]} numberOfLines={2}>
          {item.shortDescription}
        </Text>
      </View>
      <Feather name="chevron-right" size={18} color={colors.mutedForeground} />
    </Pressable>
  );
}

export default function HomeScreen() {
  const colors = useColors();
  const insets = useSafeAreaInsets();
  const topPad = Platform.OS === 'web' ? 67 : insets.top;
  const bottomPad = Platform.OS === 'web' ? 34 : insets.bottom + 60;

  const { data: stats, isLoading: statsLoading } = useGetAgencyStats();
  const { data: services, isLoading: servicesLoading } = useListServices();

  const handleServicePress = (slug: string) => {
    Haptics.impactAsync(Haptics.ImpactFeedbackStyle.Light);
    router.push(`/service/${slug}`);
  };

  const handleAuditPress = () => {
    Haptics.impactAsync(Haptics.ImpactFeedbackStyle.Medium);
    router.push('/(tabs)/contact');
  };

  return (
    <ScrollView
      style={[styles.container, { backgroundColor: colors.background }]}
      contentContainerStyle={{ paddingTop: topPad, paddingBottom: bottomPad }}
      showsVerticalScrollIndicator={false}
    >
      {/* Sticky-style logo header */}
      <View style={[styles.appHeader, { backgroundColor: colors.background, borderBottomColor: colors.border }]}>
        <Image source={logoImage} style={styles.appHeaderLogo} resizeMode="contain" />
        <Text style={[styles.appHeaderTitle, { color: colors.foreground }]}>
          SearchEngine<Text style={{ color: colors.primary }}>Optimization.ae</Text>
        </Text>
      </View>

      {/* Hero */}
      <View style={[styles.heroSection, { marginTop: 16 }]}>
        <View style={styles.badge}>
          <View style={[styles.badgeDot, { backgroundColor: colors.accent }]} />
          <Text style={[styles.badgeText, { color: colors.accent }]}>UAE's #1 SEO Agency</Text>
        </View>
        <Text style={[styles.heroTitle, { color: colors.foreground }]}>
          Rank Higher.{'\n'}
          <Text style={{ color: colors.primary }}>Grow Faster.</Text>
        </Text>
        <Text style={[styles.heroSubtitle, { color: colors.mutedForeground }]}>
          Data-driven SEO strategies that deliver measurable results across the Middle East and beyond.
        </Text>
        <Pressable
          style={({ pressed }) => [
            styles.ctaButton,
            { backgroundColor: colors.primary, opacity: pressed ? 0.85 : 1 },
          ]}
          onPress={handleAuditPress}
        >
          <Text style={[styles.ctaButtonText, { color: colors.primaryForeground }]}>
            Get Free Audit
          </Text>
          <Feather name="arrow-right" size={16} color={colors.primaryForeground} />
        </Pressable>
      </View>

      {/* Stats */}
      <View style={styles.sectionHeader}>
        <Text style={[styles.sectionTitle, { color: colors.foreground }]}>Agency Stats</Text>
      </View>
      {statsLoading ? (
        <ActivityIndicator color={colors.primary} style={{ marginVertical: 24 }} />
      ) : stats ? (
        <View style={styles.statsGrid}>
          <StatCard value={`${stats.clientsServed}+`} label="Clients Served" color={colors.primary} />
          <StatCard value={`${stats.projectsCompleted}+`} label="Projects" color={colors.accent} />
          <StatCard value={`${stats.yearsExperience}+`} label="Years" color={colors.primary} />
          <StatCard value={`${stats.countriesReached}+`} label="Countries" color={colors.accent} />
        </View>
      ) : null}

      {/* Services */}
      <View style={[styles.sectionHeader, { marginTop: 8 }]}>
        <Text style={[styles.sectionTitle, { color: colors.foreground }]}>Our Services</Text>
        <Pressable onPress={() => router.push('/(tabs)/services')}>
          <Text style={[styles.seeAll, { color: colors.primary }]}>See all</Text>
        </Pressable>
      </View>
      {servicesLoading ? (
        <ActivityIndicator color={colors.primary} style={{ marginVertical: 24 }} />
      ) : services && services.length > 0 ? (
        <View style={styles.servicesList}>
          {services.slice(0, 5).map((s) => (
            <ServiceRow key={s.slug} item={s} onPress={() => handleServicePress(s.slug)} />
          ))}
        </View>
      ) : (
        <View style={styles.emptyState}>
          <Feather name="inbox" size={32} color={colors.mutedForeground} />
          <Text style={[styles.emptyText, { color: colors.mutedForeground }]}>No services found</Text>
        </View>
      )}

      {/* Bottom CTA */}
      <View style={[styles.bottomCta, { backgroundColor: colors.card, borderColor: colors.border }]}>
        <Ionicons name="analytics" size={28} color={colors.accent} />
        <Text style={[styles.bottomCtaTitle, { color: colors.foreground }]}>
          Ready to dominate search rankings?
        </Text>
        <Text style={[styles.bottomCtaSubtitle, { color: colors.mutedForeground }]}>
          Get a free SEO audit tailored to your business.
        </Text>
        <Pressable
          style={({ pressed }) => [
            styles.ctaButtonOutline,
            { borderColor: colors.primary, opacity: pressed ? 0.75 : 1 },
          ]}
          onPress={handleAuditPress}
        >
          <Text style={[styles.ctaButtonOutlineText, { color: colors.primary }]}>
            Request Audit
          </Text>
        </Pressable>
      </View>
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1 },
  appHeader: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 10,
    paddingHorizontal: 20,
    paddingVertical: 12,
    borderBottomWidth: StyleSheet.hairlineWidth,
  },
  appHeaderLogo: {
    width: 36,
    height: 36,
  },
  appHeaderTitle: {
    fontSize: 15,
    fontFamily: 'Inter_700Bold',
    letterSpacing: -0.3,
  },
  heroSection: { paddingHorizontal: 20, marginBottom: 28 },
  badge: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 6,
    marginBottom: 12,
  },
  badgeDot: { width: 6, height: 6, borderRadius: 3 },
  badgeText: { fontSize: 12, fontFamily: 'Inter_600SemiBold', letterSpacing: 0.5 },
  heroTitle: {
    fontSize: 34,
    fontFamily: 'Inter_700Bold',
    lineHeight: 40,
    marginBottom: 10,
  },
  heroSubtitle: {
    fontSize: 15,
    fontFamily: 'Inter_400Regular',
    lineHeight: 22,
    marginBottom: 20,
  },
  ctaButton: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
    gap: 8,
    paddingVertical: 14,
    paddingHorizontal: 24,
    borderRadius: 10,
    alignSelf: 'flex-start',
  },
  ctaButtonText: { fontSize: 15, fontFamily: 'Inter_600SemiBold' },
  sectionHeader: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    paddingHorizontal: 20,
    marginBottom: 12,
  },
  sectionTitle: { fontSize: 18, fontFamily: 'Inter_700Bold' },
  seeAll: { fontSize: 14, fontFamily: 'Inter_500Medium' },
  statsGrid: {
    flexDirection: 'row',
    flexWrap: 'wrap',
    paddingHorizontal: 16,
    gap: 10,
    marginBottom: 20,
  },
  statCard: {
    width: '47%',
    padding: 16,
    borderRadius: 10,
    borderWidth: 1,
    alignItems: 'center',
  },
  statValue: { fontSize: 28, fontFamily: 'Inter_700Bold', marginBottom: 4 },
  statLabel: { fontSize: 12, fontFamily: 'Inter_500Medium' },
  servicesList: { paddingHorizontal: 16, gap: 8, marginBottom: 20 },
  serviceRow: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 12,
    padding: 14,
    borderRadius: 10,
    borderWidth: 1,
  },
  serviceIconBox: {
    width: 36,
    height: 36,
    borderRadius: 8,
    alignItems: 'center',
    justifyContent: 'center',
  },
  serviceRowContent: { flex: 1 },
  serviceRowTitle: { fontSize: 14, fontFamily: 'Inter_600SemiBold', marginBottom: 2 },
  serviceRowDesc: { fontSize: 12, fontFamily: 'Inter_400Regular', lineHeight: 17 },
  emptyState: { alignItems: 'center', paddingVertical: 32, gap: 8 },
  emptyText: { fontSize: 14, fontFamily: 'Inter_400Regular' },
  bottomCta: {
    margin: 16,
    padding: 20,
    borderRadius: 12,
    borderWidth: 1,
    alignItems: 'center',
    gap: 8,
  },
  bottomCtaTitle: { fontSize: 16, fontFamily: 'Inter_700Bold', textAlign: 'center' },
  bottomCtaSubtitle: { fontSize: 13, fontFamily: 'Inter_400Regular', textAlign: 'center', lineHeight: 18 },
  ctaButtonOutline: {
    paddingVertical: 12,
    paddingHorizontal: 24,
    borderRadius: 8,
    borderWidth: 1.5,
    marginTop: 4,
  },
  ctaButtonOutlineText: { fontSize: 14, fontFamily: 'Inter_600SemiBold' },
});
