import React, { useState } from 'react';
import {
  ActivityIndicator,
  Platform,
  Pressable,
  ScrollView,
  StyleSheet,
  Text,
  View,
} from 'react-native';
import { useLocalSearchParams, router } from 'expo-router';
import { useGetService } from '@workspace/api-client-react';
import { useColors } from '@/hooks/useColors';
import { Feather, Ionicons } from '@expo/vector-icons';
import { useSafeAreaInsets } from 'react-native-safe-area-context';
import * as Haptics from 'expo-haptics';

function BenefitRow({ text }: { text: string }) {
  const colors = useColors();
  return (
    <View style={styles.benefitRow}>
      <Ionicons name="checkmark-circle" size={18} color={colors.accent} />
      <Text style={[styles.benefitText, { color: colors.foreground }]}>{text}</Text>
    </View>
  );
}

function ProcessStep({ step, title, description }: { step: number; title: string; description: string }) {
  const colors = useColors();
  return (
    <View style={styles.processStep}>
      <View style={[styles.stepNumber, { backgroundColor: colors.primary }]}>
        <Text style={[styles.stepNumText, { color: colors.primaryForeground }]}>{step}</Text>
      </View>
      <View style={styles.stepContent}>
        <Text style={[styles.stepTitle, { color: colors.foreground }]}>{title}</Text>
        <Text style={[styles.stepDesc, { color: colors.mutedForeground }]}>{description}</Text>
      </View>
    </View>
  );
}

function FaqItem({ question, answer }: { question: string; answer: string }) {
  const colors = useColors();
  const [open, setOpen] = useState(false);
  return (
    <Pressable
      style={({ pressed }) => [
        styles.faqItem,
        { borderColor: colors.border, opacity: pressed ? 0.8 : 1 },
      ]}
      onPress={() => {
        Haptics.impactAsync(Haptics.ImpactFeedbackStyle.Light);
        setOpen((v) => !v);
      }}
    >
      <View style={styles.faqHeader}>
        <Text style={[styles.faqQuestion, { color: colors.foreground }]}>{question}</Text>
        <Feather
          name={open ? 'minus' : 'plus'}
          size={16}
          color={colors.mutedForeground}
        />
      </View>
      {open && (
        <Text style={[styles.faqAnswer, { color: colors.mutedForeground }]}>{answer}</Text>
      )}
    </Pressable>
  );
}

export default function ServiceDetailScreen() {
  const { slug } = useLocalSearchParams<{ slug: string }>();
  const colors = useColors();
  const insets = useSafeAreaInsets();
  const bottomPad = Platform.OS === 'web' ? 34 : insets.bottom + 16;

  const { data: service, isLoading, isError, refetch } = useGetService(slug ?? '');

  if (isLoading) {
    return (
      <View style={[styles.centered, { backgroundColor: colors.background }]}>
        <ActivityIndicator color={colors.primary} size="large" />
      </View>
    );
  }

  if (isError || !service) {
    return (
      <View style={[styles.centered, { backgroundColor: colors.background }]}>
        <Feather name="alert-circle" size={36} color={colors.destructive} />
        <Text style={[styles.errorText, { color: colors.mutedForeground }]}>
          Failed to load service
        </Text>
        <Pressable
          style={[styles.retryBtn, { borderColor: colors.primary }]}
          onPress={() => refetch()}
        >
          <Text style={[styles.retryText, { color: colors.primary }]}>Retry</Text>
        </Pressable>
      </View>
    );
  }

  return (
    <ScrollView
      style={[styles.container, { backgroundColor: colors.background }]}
      contentContainerStyle={{ paddingBottom: bottomPad }}
      showsVerticalScrollIndicator={false}
    >
      {/* Hero */}
      <View style={[styles.hero, { backgroundColor: colors.card, borderBottomColor: colors.border }]}>
        <View style={[styles.heroIconBox, { backgroundColor: colors.secondary }]}>
          <Ionicons name="search" size={28} color={colors.primary} />
        </View>
        <View style={[styles.categoryBadge, { backgroundColor: '#1A2540' }]}>
          <Text style={[styles.categoryText, { color: colors.primary }]}>{service.category}</Text>
        </View>
        <Text style={[styles.heroTitle, { color: colors.foreground }]}>{service.title}</Text>
        <Text style={[styles.heroDesc, { color: colors.mutedForeground }]}>
          {service.shortDescription}
        </Text>
      </View>

      {/* Full description */}
      <View style={styles.section}>
        <Text style={[styles.fullDesc, { color: colors.foreground }]}>
          {service.fullDescription}
        </Text>
      </View>

      {/* Benefits */}
      {service.benefits.length > 0 && (
        <View style={styles.section}>
          <Text style={[styles.sectionTitle, { color: colors.foreground }]}>Key Benefits</Text>
          <View style={[styles.card, { backgroundColor: colors.card, borderColor: colors.border }]}>
            {service.benefits.map((b, i) => (
              <BenefitRow key={i} text={b} />
            ))}
          </View>
        </View>
      )}

      {/* Process */}
      {service.process.length > 0 && (
        <View style={styles.section}>
          <Text style={[styles.sectionTitle, { color: colors.foreground }]}>Our Process</Text>
          <View style={[styles.card, { backgroundColor: colors.card, borderColor: colors.border }]}>
            {service.process.map((p) => (
              <ProcessStep
                key={p.step}
                step={p.step}
                title={p.title}
                description={p.description}
              />
            ))}
          </View>
        </View>
      )}

      {/* Technologies */}
      {service.technologies.length > 0 && (
        <View style={styles.section}>
          <Text style={[styles.sectionTitle, { color: colors.foreground }]}>Technologies</Text>
          <View style={styles.techWrap}>
            {service.technologies.map((t, i) => (
              <View key={i} style={[styles.techChip, { backgroundColor: colors.secondary, borderColor: colors.border }]}>
                <Text style={[styles.techText, { color: colors.mutedForeground }]}>{t}</Text>
              </View>
            ))}
          </View>
        </View>
      )}

      {/* FAQs */}
      {service.faqs.length > 0 && (
        <View style={styles.section}>
          <Text style={[styles.sectionTitle, { color: colors.foreground }]}>FAQs</Text>
          <View style={styles.faqList}>
            {service.faqs.map((f, i) => (
              <FaqItem key={i} question={f.question} answer={f.answer} />
            ))}
          </View>
        </View>
      )}

      {/* CTA */}
      <View style={styles.section}>
        <Pressable
          style={({ pressed }) => [
            styles.ctaButton,
            { backgroundColor: colors.primary, opacity: pressed ? 0.85 : 1 },
          ]}
          onPress={() => {
            Haptics.impactAsync(Haptics.ImpactFeedbackStyle.Medium);
            router.push('/(tabs)/contact');
          }}
        >
          <Text style={[styles.ctaText, { color: colors.primaryForeground }]}>
            Get a Free Audit
          </Text>
          <Feather name="arrow-right" size={16} color={colors.primaryForeground} />
        </Pressable>
      </View>
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1 },
  centered: { flex: 1, alignItems: 'center', justifyContent: 'center', gap: 12 },
  errorText: { fontSize: 14, fontFamily: 'Inter_400Regular' },
  retryBtn: {
    paddingVertical: 10,
    paddingHorizontal: 24,
    borderRadius: 8,
    borderWidth: 1.5,
  },
  retryText: { fontSize: 14, fontFamily: 'Inter_600SemiBold' },
  hero: {
    padding: 24,
    alignItems: 'center',
    borderBottomWidth: 1,
    gap: 10,
  },
  heroIconBox: {
    width: 60,
    height: 60,
    borderRadius: 16,
    alignItems: 'center',
    justifyContent: 'center',
    marginBottom: 4,
  },
  categoryBadge: {
    paddingHorizontal: 12,
    paddingVertical: 4,
    borderRadius: 20,
  },
  categoryText: { fontSize: 12, fontFamily: 'Inter_600SemiBold' },
  heroTitle: { fontSize: 22, fontFamily: 'Inter_700Bold', textAlign: 'center' },
  heroDesc: {
    fontSize: 14,
    fontFamily: 'Inter_400Regular',
    textAlign: 'center',
    lineHeight: 21,
  },
  section: { paddingHorizontal: 16, paddingTop: 20, gap: 10 },
  sectionTitle: { fontSize: 17, fontFamily: 'Inter_700Bold' },
  fullDesc: { fontSize: 14, fontFamily: 'Inter_400Regular', lineHeight: 22 },
  card: { borderRadius: 12, borderWidth: 1, overflow: 'hidden' },
  benefitRow: {
    flexDirection: 'row',
    alignItems: 'flex-start',
    gap: 10,
    padding: 12,
  },
  benefitText: { fontSize: 13, fontFamily: 'Inter_400Regular', flex: 1, lineHeight: 19 },
  processStep: {
    flexDirection: 'row',
    gap: 12,
    padding: 14,
  },
  stepNumber: {
    width: 28,
    height: 28,
    borderRadius: 14,
    alignItems: 'center',
    justifyContent: 'center',
    flexShrink: 0,
    marginTop: 2,
  },
  stepNumText: { fontSize: 13, fontFamily: 'Inter_700Bold' },
  stepContent: { flex: 1, gap: 4 },
  stepTitle: { fontSize: 14, fontFamily: 'Inter_600SemiBold' },
  stepDesc: { fontSize: 13, fontFamily: 'Inter_400Regular', lineHeight: 19 },
  techWrap: { flexDirection: 'row', flexWrap: 'wrap', gap: 8 },
  techChip: {
    paddingHorizontal: 12,
    paddingVertical: 6,
    borderRadius: 8,
    borderWidth: 1,
  },
  techText: { fontSize: 12, fontFamily: 'Inter_500Medium' },
  faqList: { gap: 8 },
  faqItem: {
    borderWidth: 1,
    borderRadius: 10,
    padding: 14,
    gap: 8,
  },
  faqHeader: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'flex-start',
    gap: 8,
  },
  faqQuestion: { fontSize: 14, fontFamily: 'Inter_600SemiBold', flex: 1, lineHeight: 20 },
  faqAnswer: { fontSize: 13, fontFamily: 'Inter_400Regular', lineHeight: 19 },
  ctaButton: {
    paddingVertical: 15,
    borderRadius: 10,
    alignItems: 'center',
    justifyContent: 'center',
    flexDirection: 'row',
    gap: 8,
  },
  ctaText: { fontSize: 15, fontFamily: 'Inter_600SemiBold' },
});
